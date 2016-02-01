<?php

namespace Awesovel\Defaults;

use Validator;
use Awesovel\Helpers\Json;
use Awesovel\Helpers\Parse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller AS IlluminateController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Awesovel\Helpers\Path;

class Controller extends IlluminateController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var
     */
    protected $data;

    /**
     * @var
     */
    protected $errors;

    /**
     * @var
     */
    protected $module;

    /**
     * @var
     */
    protected $entity;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * Controller constructor.
     * @param $module
     * @param $entity
     */
    public function __construct($module, $entity)
    {
        $this->module = Parse::camelize($module, true);
        $this->entity = Parse::camelize($entity, true);
    }

    /**
     *
     * Process api operations of Model
     *
     * @param $version
     * @param $operation
     * @param null $data
     * @param null $relationships
     *
     * @return mixed
     */
    public function api($version, $operation, $data = null, $relationships = null)
    {
        return ($this->create($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create($data)
    {

        $path = Path::name($this->module, $this->entity);

        $status = 'E';
        $result = false;

        if (class_exists($path)) {

            $model = new $path();

            $validator = Validator::make($data, [
                'name' => 'required',
            ]);

            if (!$validator->fails()) {


                $items = $model->getItems();

                foreach ($items as $item) {

                    $id = $item->id;

                    if (isset($data[$id])) {
                        $model->$id = $data[$id];
                    }
                }

                $status = $model->save() ? 'S' : 'F';

                $result = $model->id;

            } else {

                $result = $validator->errors()->all();
            }
        }

        return Json::encode(array('status' => $status, 'result' => $result));
    }

    /**
     * Resolve app requests
     *
     * @param null $index
     * @param null $id
     * @param null $language
     * @param array $parameters
     * @return mixed
     */
    public function resolve($index = null, $id = null, $language = null, $parameters = [])
    {

        if (is_null($index)) {
            $index = 'index';
        }

        $this->errors = [];

        $view = awesovel_app('layouts.error');
        $actions = [];

        $_form = Parse::form($this->module, $this->entity, $index);

        $form = '';

        if ($_form) {

            //$actions = $this->actions($form);
            $form = $_form->id;

            $layout = $_form->layout;

            if (view()->exists($view)) {
                $view = awesovel_app('layouts.' . $layout);
            }
        }

        $this->data = [
            'module' => $this->module,
            'entity' => $this->entity,
            'form' => $form,
            'language' => $language,
            'parameters' => $parameters
        ];

        return view($view, $this->data, $this->errors, $parameters);
    }

}
