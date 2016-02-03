/* global angular, document, window */
'use strict';

App
    .angular

    .controller('FormController', ['$scope', 'ServiceApi', 'ServiceDialog', function ($scope, ServiceApi, ServiceDialog) {

        var vm = this;

        var module = '{{module}}';
        var entity = '{{entity}}';
        var token = $('meta[name="csrf-token"]').attr('content');


        vm.fields = [];
        vm.actions = [];


        vm.form = '{{form}}';
        vm.language = '{{language}}';


        vm.collection = {};
        if (vm.form.templateOptions.recover) {
            ServiceApi.collection(token, module, entity, vm.form.templateOptions.recover, vm.form.templateOptions.parameters, function (status, response) {
                vm.collection = response.data.result;
                if (vm.form.templateOptions.limit) {
                    vm.collection = response.data.result[vm.form.templateOptions.limit - 1];
                }
            });
        }


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


        vm.resolve = function (action, data) {

            console.log(vm.collection);

            ServiceApi.resolve(token, action.type, module, entity, action, data, vm.collection, function (status, response) {

                ServiceDialog.alert('title', response.data);
            });
        };

        $scope.vm = vm;
    }]);
