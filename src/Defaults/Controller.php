<?php

namespace Awesovel\Defaults;

use Awesovel\Helpers\Json;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Awesovel\Helpers\Path;

class Controller extends RoutingController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $module;
    private $entity;
    private $model;

    private $data;
    private $errors;

    public function __construct($module, $entity)
    {
        $this->module = $module;
        $this->entity = $entity;

        $path = Path::name($module, $entity);

        $this->model = new $path();
    }

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'awesovel.layouts.index',
            $this->data,
            $this->errors
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
