
<div class="formly-toolbar">

    <span ng-repeat="_action in vm.form.actions.{{ $action_position }}">
        <button class="btn btn-raised btn-default" title="@{{ _action.title }}" type="button"
                ng-class="_action.className"
                ng-click="vm.resolve(_action)">
            <span class="@{{ _action.classIcon }}" ng-show="_action.classIcon"></span>
            @{{ _action.label }}
        </button>
    </span>

    <ul class="pagination pull-right">
        <li ng-class="{disabled: (pagination.current == 1 || pagination.current == 2)}">
            <a href="" ng-click="pagination.get(1)">&laquo;</a>
        </li>
        <li ng-class="{disabled: pagination.current == 1}">
            <a href="" ng-click="pagination.get(pagination.current -1)">&lsaquo;</a>
        </li>
        <li>
            <input type="text" ng-model="pagination.current" style="border-radius: 0;"
                   ng-change="pagination.get(pagination.current)" min="1" max="@{{ pagination.last }}"
            />
        </li>
        <li ng-class="{disabled: pagination.current == pagination.last}">
            <a href="" ng-click="pagination.get(pagination.current +1)">&rsaquo;</a>
        </li>
        <li ng-class="{disabled: (pagination.current == pagination.last || pagination.current == pagination.last - 1)}">
            <a href="" ng-click="pagination.get(pagination.last)">&raquo;</a>
        </li>
    </ul>

    <div class="form-group" style="float: right;margin: 0 10px 0 0; width: 70px;">
        <div class="form-control--container">
            <input type="number" class="form-control" ng-model="pagination.skip" min="1"
                   ng-change="pagination.get(pagination.current)"/>
            <span class="form-control--bar"></span>
        </div>
    </div>

    <div class="form-group" style="float: right;margin: 0 20px 0 0; width: 400px;">
        <div class="form-control--container">
            <input type="text" class="form-control" placeholder="Pesquisar..."
                   ng-model="pagination.search" ng-change="pagination.get(1, true)">
            <span class="form-control--bar"></span>
        </div>
    </div>

</div>