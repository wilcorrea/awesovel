/* global angular, document, window */
'use strict';

App
    .angular

    .controller('FormController', ['$scope', 'ServiceApi', 'ServiceDialog', function ($scope, ServiceApi, ServiceDialog) {

        var vm = this;

        var module = '{{module}}';
        var entity = '{{entity}}';
        var _token = $('meta[name="csrf-token"]').attr('content');


        vm.fields = [];
        vm.actions = [];
        vm.data = {};

        vm.form = '{{form}}';
        vm.language = '{{language}}';


        if (angular.isArray(vm.form.fields)) {

            var fields = vm.form.fields;
            fields.forEach(function (row) {
                if (angular.isArray(row.fieldGroup)) {
                    row.fieldGroup.forEach(function (field) {
                        field.templateOptions = angular.extend(field.templateOptions, vm.language.items[field.key]);
                    });
                } else {
                    row.templateOptions = angular.extend(row.templateOptions, vm.language.items[row.key]);
                }
            });
            vm.fields = fields;
        }


        var actions = vm.form.actions;
        for (var i in actions) {
            actions[i].forEach(function (action) {
                action = angular.extend(action, vm.language.actions[action.id])
            });
        }
        vm.actions = actions;


        vm.resolve = function (action) {

            ServiceApi.resolve(_token, action.type, module, entity, action.id, vm.data, function (status, response) {

                ServiceDialog.alert('title', response.data);
            });
        };

        $scope.vm = vm;
    }]);
