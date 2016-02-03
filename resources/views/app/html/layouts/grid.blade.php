@extends('awesovel.app.html.index')

@section('head')

    @include('awesovel.app.html.head')

@endsection

@section('layout')

    <div class="row card">

        <form ng-controller="FormController">

            <h5>@{{ vm.language.label }}</h5>

            <div class="formly-fieldset">

                <div class="formly-toolbar">
                    <span ng-repeat="_action in vm.form.actions.top">
                        <button class="btn btn-raised btn-default" title="@{{ _action.title }}" type="button"
                                ng-class="_action.className"
                                ng-click="vm.resolve(_action)">
                            <span class="@{{ _action.classIcon }}" ng-show="_action.classIcon"></span>
                            @{{ _action.label }}
                        </button>
                    </span>
                </div>

                <div class="grid-container-responsive--wrapper">

                    <div class="grid-container-responsive">

                        <div class="grid-container">

                            <div class="grid-head col-sm-12">
                                <div class="col-sm-2 grid-head-toolbar">
                                    {{ "Opções" }}
                                </div>
                                <div ng-repeat="_field in vm.fields" class="grid-head-column"
                                     ng-class="_field.className">
                                    @{{ _field.templateOptions.label }}
                                </div>
                            </div>

                            <div class="grid-body col-sm-12">
                                <div class="grid-body-row col-sm-12" ng-repeat="_row in vm.collection">

                                    <div class="col-sm-2 grid-body-toolbar">
                                        <span ng-repeat="_action in vm.form.actions.middle">
                                            <button class="btn btn-raised btn-default" title="@{{ _action.title }}"
                                                    type="button"
                                                    ng-class="_action.className"
                                                    ng-click="vm.resolve(_action, _row)">
                                                <span class="@{{ _action.classIcon }}" ng-show="_action.classIcon"></span>
                                                @{{ _action.label }}
                                            </button>
                                        </span>
                                    </div>

                                    <div ng-repeat="_field in vm.fields" class="grid-body-column"
                                         ng-class="_field.className">
                                        @{{ _row[_field.key] }}
                                    </div>
                                </div>
                            </div>
                            <br class="grid-bottom"/>

                        </div>

                    </div>
                </div>

                <div class="formly-toolbar">
                    <span ng-repeat="_action in vm.form.actions.bottom">
                        <button class="btn btn-raised btn-default" title="@{{ _action.title }}" type="button"
                                ng-class="_action.className"
                                ng-click="vm.resolve(_action)">
                            <span class="@{{ _action.classIcon }}" ng-show="_action.classIcon"></span>
                            @{{ _action.label }}
                        </button>
                    </span>
                </div>

            </div>

        </form>

    </div>

@endsection