<?php
/**
 * Created by PhpStorm.
 * User: analista
 * Date: 13/01/16
 * Time: 16:25
 */

namespace Awesovel\Controllers;

use Awesovel\Helpers\Parse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Awesovel\Helpers\Path;

class AwesovelAppController extends Controller
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
     * @var \Awesovel\Defaults\Model
     */
    protected $model;

    /**
     * @var StdClass
     */
    protected $operation;

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

        $path = Path::name($this->module, $this->entity);

        $this->model = new $path();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $total = isset($this->parameters['total']) ? $this->parameters['total'] : config('awesovel')['total'];

        $this->data['collection'] = $this->api('HEAD', 'paginate', $total);


        return $this->view($this->operation->layout, ['items' => $this->model->getItems()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['collection'] = (object)[];

        return $this->view($this->operation->layout);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['collection'] = $this->api('HEAD', 'find', $id);

        return $this->view($this->operation->layout);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['collection'] = $this->api('HEAD', 'find', $id);

        return $this->view($this->operation->layout);
    }

    /**
     * Show the form for remove the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $this->data['collection'] = $this->api('HEAD', 'find', $id);

        return $this->view($this->operation->layout);
    }

    /**
     * @return object
     */
    private function actions() {

        $positions = [
            'top' => [],
            'middle' => [],
            'bottom' => []
        ];

        foreach ($this->operation->operations as $operation) {

            foreach ($positions as $key => $available) {

                if (is_array($operation->position) && in_array($key, $operation->position)) {
                    $positions[$key][] = $operation;
                }
            }
        }

        return (object) $positions;
    }

    /**
     * @param $layout
     * @param $parameters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($layout, $parameters = null) {

        $this->data['_colletion'] = null;
        $this->data['actions'] = $this->actions();

        $this->data['module'] = $this->module;
        $this->data['entity'] = $this->entity;

        return view(awesovel_app('layouts.' . $layout), $this->data, $this->errors, $parameters);
    }

}