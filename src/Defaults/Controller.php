<?php

namespace Awesovel\Defaults;

use Awesovel\Helpers\Json;
use Awesovel\Controllers\AwesovelRouteController;
use Awesovel\Helpers\Parse;

class Controller extends AwesovelRouteController
{

    /**
     *
     * Process api operations of Model
     *
     * @param $version
     * @param $operation
     * @param null $id
     * @param null $relationships
     * @param null $json
     * @return mixed
     */
    public function api($version, $operation, $id = null, $relationships = null, $json = null)
    {

        if (is_null($id)) {

            $collection = $this->model->$operation();
        } else {

            $collection = $this->model->$operation($id);
        }

        if ($relationships) {

            if (is_array($collection)) {
                $collection = $collection[0];
            }

            $relationships = explode(',', $relationships);
            foreach ($relationships as $relationship) {
                $collection->$relationship = $collection->$relationship;
            }
        }

        if ($version === 'debug') {

            dd(Json::decode(Json::encode($collection)));
        } else {

            if ($json) {
                $collection = Json::decode(Json::encode($collection));
            }
            return $collection;
        }
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

        $this->operation = Parse::operation($this->module, $this->entity, $index, $language);

        $this->parameters = $parameters;

        $this->parameters['id'] = $id;

        $this->data = [
            'operation' => $this->operation,
            'language' => $language
        ];
        $this->errors = [];

        return $this->$index($id);
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
