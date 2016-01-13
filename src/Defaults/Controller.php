<?php

namespace Awesovel\Defaults;

use Awesovel\Helpers\Json;
use Awesovel\Helpers\Path;
use Awesovel\Controllers\AwesovelRouteController;

class Controller extends AwesovelRouteController
{

    private $module;
    private $entity;
    private $model;

    /**
     * Controller constructor.
     * @param $module
     * @param $entity
     */
    public function __construct($module, $entity)
    {
        $this->module = $module;
        $this->entity = $entity;

        $path = Path::name($module, $entity);

        $this->model = new $path();
    }

    /**
     *
     * Process api operations of Model
     *
     * @param $version
     * @param $operation
     * @param null $id
     * @param null $relationships
     * @return mixed
     */
    public function api($version, $operation, $id = null, $relationships = null)
    {

        if (is_null($id)) {

            $request = $this->model->$operation();
        } else {

            $request = $this->model->$operation($id);
        }

        if ($relationships) {

            if (is_array($request)) {
                $request = $request[0];
            }

            $relationships = explode(',', $relationships);
            foreach ($relationships as $relationship) {
                $request->$relationship = $request->$relationship;
            }
        }

        if ($version === 'debug') {

            dd(Json::decode(Json::encode($request)));
        } else {

            return $request;
        }
    }

    /**
     * Resolve app requests
     *
     * @param null $operation
     * @param null $id
     * @return mixed
     */
    public function resolve($operation = null, $id = null)
    {

        /*
         * TODO: recover from config.json
         */
        if (is_null($operation)) {
            $operation = 'index';
        }

        $layout = "index";
        $this->data = [
            'data' => [
                $this->api('', 'all', $id)
            ],
            'operation' => (object)[
                'title' => 'Listagem'
            ]
        ];
        $this->errors = [];

        return $this->$layout();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
