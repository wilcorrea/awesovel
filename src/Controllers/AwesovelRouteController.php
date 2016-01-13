<?php
/**
 * Created by PhpStorm.
 * User: analista
 * Date: 13/01/16
 * Time: 16:25
 */

namespace Awesovel\Controllers;

use Awesovel\Helpers\Json;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        return view(
            'awesovel.layouts.create',
            $this->data,
            $this->errors
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view(
            'awesovel.layouts.show',
            $this->data,
            $this->errors
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(
            'awesovel.layouts.edit',
            $this->data,
            $this->errors
        );
    }

}