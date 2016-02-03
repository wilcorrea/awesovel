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

                <formly-form form="vm.__form" model="vm.collection" fields="vm.fields"></formly-form>

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