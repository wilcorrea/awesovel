<?php
/**
 * Created by PhpStorm.
 * User: analista
 * Date: 13/01/16
 * Time: 16:25
 */

namespace Awesovel\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Awesovel\Helpers\Path;

class AwesovelRouteController extends Controller
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
        $this->module = $module;
        $this->entity = $entity;

        $path = Path::name($module, $entity);

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

        return $this->view('awesovel.layouts.index', ['items' => $this->model->getItems()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['collection'] = new StdClass();

        return $this->view('awesovel.layouts.create');
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

        return $this->view('awesovel.layouts.show');
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

        return $this->view('awesovel.layouts.edit');
    }

    /**
     * @param $layout
     * @param $parameters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($layout, $parameters = null) {

        return view($layout, $this->data, $this->errors, $parameters);
    }

}