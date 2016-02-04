/* global angular, document, window */
'use strict';

App
    .angular

    .controller('FormController', ['$scope', 'ServiceApi', 'ServiceDialog', function ($scope, ServiceApi, ServiceDialog) {

        var vm = this;

        var module = '{{module}}';
        var entity = '{{entity}}';
        var token = App.token;


        vm.fields = [];
        vm.actions = [];


        vm.form = '{{form}}';
        vm.language = '{{language}}';


        var
            current = 1,
            skip = 5,
            search = '',
            id = module + '.' + entity + '.' + vm.form.id,
            custom = localStorage.getItem(id),
            temp = 'form.storage',
            stored = localStorage.getItem(temp);

        if (custom) {

            custom = JSON.parse(custom);
            skip = custom.skip;
        }

        if (stored) {

            stored = JSON.parse(stored);

            if (stored.id === id) {
                current = stored.current;
                search = stored.search;
            }
        }


        $scope.pagination = {
            current: current,
            skip: skip,
            search: search,
            last: 0,
            total: 0,
            get: function (page) {

                if (page > 0
                    && (page <= $scope.pagination.last || $scope.pagination.last === 0)
                    && $scope.pagination.skip > 0) {

                    $scope.pagination.current = page;

                    var search = {};

                    if ($scope.pagination.search) {

                        if (vm.form.templateOptions.items) {

                            for (var i in vm.form.templateOptions.items) {

                                var item = vm.form.templateOptions.items[i];
                                if (item.search) {

                                    search[i] = $scope.pagination.search;
                                }
                            }
                        }
                    }

                    var pagination = App.pagination($scope.pagination.skip, (page - 1) * $scope.pagination.skip, search);

                    if (vm.form.templateOptions.limit === 0) {

                        localStorage.setItem(temp, JSON.stringify({
                            id: id,
                            current: page,
                            search: $scope.pagination.search
                        }));

                        localStorage.setItem(id, JSON.stringify({
                            skip: pagination.take
                        }));
                    }

                    ServiceApi.collection(token, module, entity, vm.form.templateOptions.recover, vm.form.templateOptions.parameters, pagination, function (status, response) {

                        vm.collection = response.data.result.collection;

                        if (vm.collection) {
                            if (vm.form.templateOptions.limit) {
                                vm.collection = response.data.result.collection[vm.form.templateOptions.limit - 1];
                            }

                            $scope.pagination.total = response.data.result.total;
                            $scope.pagination.last = Math.ceil(response.data.result.total / $scope.pagination.skip);

                            if (page > $scope.pagination.last && $scope.pagination.last !== 0) {

                                $scope.pagination.get($scope.pagination.last);
                            }
                        }
                    });
                }

            }
        };


        vm.collection = {};
        if (vm.form.templateOptions.recover) {
            $scope.pagination.get(current);
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

            ServiceApi.resolve(token, action.type, module, entity, action, data, vm.collection, function (status, response) {

                var message = '';
                if (response.data.status && action.messages) {
                    message = action.messages[response.data.status];
                }

                ServiceDialog.alert(vm.language.label, message);
            });
        };


        $scope.vm = vm;

    }]);
