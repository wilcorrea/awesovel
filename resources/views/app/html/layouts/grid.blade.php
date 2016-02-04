@extends('awesovel.app.html.index')

@section('head')

    @include('awesovel.app.html.head')

@endsection

@section('layout')

    <div class="row card">

        <form ng-controller="FormController" ng-cloak>

            <h5>@{{ vm.language.label }}</h5>

            <div class="formly-fieldset">

                {{-- */ $action_position = 'top'; /* --}}
                @include('awesovel.app.html.partials.toolbar')

                <div class="grid-container-responsive--wrapper">

                    <div class="grid-container-responsive">

                        <div class="grid-container">

                            <div class="grid-head col-sm-12">
                                <div class="grid-head-toolbar" ng-class="vm.form.templateOptions.options.className">
                                    {{ "Opções" }}
                                </div>
                                <div ng-repeat="_field in vm.fields" class="grid-head-column"
                                     ng-class="_field.className">
                                    @{{ _field.templateOptions.label }}
                                </div>
                            </div>

                            <div class="grid-body col-sm-12">

                                <div class="grid-body-row col-sm-12" ng-repeat="_row in vm.collection">

                                    <div class="grid-body-toolbar" ng-class="vm.form.templateOptions.options.className">

                                        <span ng-repeat="_action in vm.form.actions.middle">
                                            <button class="btn btn-raised btn-default" title="@{{ _action.title }}"
                                                    type="button" ng-class="_action.className"  ng-click="vm.resolve(_action, _row)">
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

                {{-- */ $action_position = 'bottom'; /* --}}
                @include('awesovel.app.html.partials.toolbar')

            </div>

        </form>

    </div>

@endsection