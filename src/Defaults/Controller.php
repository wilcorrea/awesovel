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
     * @param $index
     * @param null $data
     * @param null $relationships
     *
     * @return mixed
     */
    public function api($version, $index, $data = null, $relationships = null)
    {
        return $this->operation($this->module, $this->entity, $version, $index, $data, $relationships);
    }

    /**
     * @param $module
     * @param $entity
     * @param $version
     * @param $index
     * @param $data
     * @param $relates
     *
     * @return mixed
     */
    private function operation($module, $entity, $version, $index, $data, $relates)
    {
        $operation = Parse::operation($module, $entity, $index);

        $action = $operation->action;

        $path = Path::name($this->module, $this->entity);

        if (class_exists($path)) {

            $values = [];

            $model = new $path();

            $relationships = [];

            if ($relates) {

                $relationships = explode(',', $relates);

                foreach ($relationships as $i => $relationship) {

                    if (isset($data[$relationship])) {

                        $values[$relationship] = $data[$relationship];
                        unset($data[$relationship]);
                    }

                    if (isset($model->relationships) && is_array($model->relationships)) {

                        foreach ($model->relationships as $relation) {
                            dd($relation);
                            if ($relation->id === $relationship) {

                                $relationships[$i] = $relation;
                            }
                        }
                    }
                }
            }


            $response = $this->response($model, $index, $version, $action, $relationships, $data, $values);
        }

        return $response;
    }

    /**
     * @param $model
     * @param $index
     * @param $version
     * @param $action
     * @param $relationships
     * @param $data
     * @param $values
     *
     * @return mixed
     */
    private function response($model, $index, $version, $action, $relationships, $data, $values)
    {
        $response = null;

        $before = $this->before($model, $index, $version, $data);
        if ($before) {

            $response = $this->$action($model, $data);

            $after = $this->after($model, $index, $version, $data, $response);
            if (!$after) {
                /*
                 * todo: merda no after
                 */
            } else {
                $responses = [];
                foreach ($relationships as $relationship) {

                    $id = $relationship->id;
                    $responses[$id] = $this->relationships($index, $version, $relationship, $response, $values[$id]);
                }

                $response->relationships = $responses;
            }
        } else {
            /**
             * todo: merda no before
             */
        }

        return $response;
    }

    /**
     * @param $index
     * @param $version
     * @param $relationship
     * @param $response
     * @param $values
     *
     * @return array
     */
    private function relationships($index, $version, $relationship, $response, $values)
    {
        $path = Path::name($relationship->module, $relationship->entity, 'Controller');

        if (class_exists($path)) {

            $controller = new $path($relationship->module, $relationship->entity);

        } else {

            $controller = new Controller($relationship->module, $relationship->entity);
        }

        $responses = [];

        foreach ($values as $data) {

            $key = $relationship->key;
            $local = $relationship->local;
            $data[$key] = $response->result->$local;

            $responses[] = $controller->api($version, $index, $data);
        }

        return $responses;
    }

    /**
     * @param $model
     * @param $index
     * @param $version
     * @param $data
     *
     * @return bool
     */
    protected function before($model, $index, $version, $data)
    {
        return true;
    }

    /**
     * @param $model
     * @param $index
     * @param $version
     * @param $data
     * @param $response
     *
     * @return bool
     */
    protected function after($model, $index, $version, $data, $response)
    {
        return true;
    }

    /**
     * @param \Awesovel\Defaults\Model $model
     * @param array $data
     *
     * @return \Awesovel\Helpers\type
     */
    public function read(Model $model, $data)
    {
        $status = 'S';

        $items = $model->getItems();

        $where = [];

        foreach ($items as $item) {

            $id = $item->id;
            if (($item->dao->select) && isset($data[$id])) {
                $where[$id] = (int) $data[$id];
            }
        }

        $result = $model::where($where)->take(5)->skip(0)->get();

        return (object)(array('status' => $status, 'result' => $result, 'log' => [$data, $where]));
    }

    /**
     * @param \Awesovel\Defaults\Model $model
     * @param array $data
     *
     * @return \Awesovel\Helpers\type
     */
    public function create(Model $model, $data)
    {
        $status = 'E';

        if (!isset($data[$model->extends->primaryKey])) {

            $result = $this->isValid($model, $data);

            if (count($result) === 0) {

                $record = $this->populate($model, $data);

                $status = $record->save() ? 'S' : 'F';

                $result = $record->id;
            }

        } else {

            return $this->update($model, $data);
        }

        return (object)(array('status' => $status, 'result' => $result, 'log' => []));
    }

    /**
     * @param \Awesovel\Defaults\Model $model
     * @param array $data
     *
     * @return \Awesovel\Helpers\type
     */
    public function update(Model $model, $data)
    {
        $status = 'E';

        if (isset($data[$model->extends->primaryKey])) {

            $record = $model::find($data[$model->extends->primaryKey]);

            $result = $this->isValid($record, $data);

            if (count($result) === 0) {

                $record = $this->populate($record, $data);

                $status = $record->save() ? 'S' : 'F';

                $result = $record->id;
            }

        } else {

            return $this->create($model, $data);
        }

        return (object)(array('status' => $status, 'result' => $result, 'log' => []));
    }

    /**
     * @param Model $model
     * @param $data
     *
     * @return Model
     */
    private function populate(Model $model, $data) {

        $items = $model->getItems();

        foreach ($items as $item) {

            $id = $item->id;

            if (isset($data[$id])) {
                $model->$id = $data[$id];
            }
        }

        return $model;
    }

    /**
     *
     * @param Model $model
     * @param $data
     *
     * @return array
     */
    private function isValid(Model $model, $data) {

        $messages = [];

        $rules = [];

        $items = $model->getItems();

        foreach ($items as $item) {

            $id = $item->id;
            if ($item->required) {
                $rules[$id] = 'required';
            }
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $messages = $validator->errors()->all();
        }

        return $messages;
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
    public function view($index = null, $id = null, $language = null, $parameters = [])
    {

        if (is_null($index)) {
            $index = 'index';
        }

        $this->errors = [];

        $view = awesovel_app('layouts.error');

        $_form = Parse::form($this->module, $this->entity, $index);

        $form = '';

        if ($_form) {

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
