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
    protected $action;

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
     * @return object
     */
    private function actions()
    {

        $positions = [
            'top' => [],
            'middle' => [],
            'bottom' => []
        ];

        //dd($this->operation->actions);

        foreach ($this->action->actions as $action) {

            foreach ($positions as $key => $available) {

                //dd($action);

                if (isset($action->position) && isset($action->position->$key)) {
                    $positions[$key][$action->position->$key] = $action;
                }

                ksort($positions[$key]);
            }
        }

        ksort($positions);
        //dd($positions);

        return (object)$positions;
    }

    /**
     *
     * @param $index
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($index, $id = null)
    {

        $layout = 'none';
        $parameters = null;
        $view = awesovel_app('layouts.error');

        if ($this->action) {

            $this->data['collection'] = (object)[];

            $layout = $this->action->layout;

            switch ($index) {
                case 'index':

                    $total = isset($this->parameters['total']) ? $this->parameters['total'] : awesovel_config('total');
                    $this->data['collection'] = $this->api('HEAD', 'paginate', $total);

                    $layout = $this->action->layout;
                    $parameters = ['items' => $this->model->getItems()];
                    break;
                case 'add':

                    break;
                case 'show':

                    $this->data['collection'] = $this->api('HEAD', 'find', $id);

                    $layout = $this->action->layout;
                    break;
                case 'edit':

                    $this->data['collection'] = $this->api('HEAD', 'find', $id);

                    $layout = $this->action->layout;
                    break;
                case 'remove':

                    $this->data['collection'] = $this->api('HEAD', 'find', $id);

                    $layout = $this->action->layout;
                    break;
            }

            $this->data['_colletion'] = null;
            $this->data['actions'] = $this->actions();

            $this->data['module'] = $this->module;
            $this->data['entity'] = $this->entity;

            if (view()->exists($view)) {
                $view = awesovel_app('layouts.' . $layout);
            }
        }

        return view($view, $this->data, $this->errors, $parameters);
    }

}