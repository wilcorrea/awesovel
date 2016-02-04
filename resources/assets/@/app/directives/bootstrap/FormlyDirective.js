/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular

    .run(
        function (formlyConfig) {

            formlyConfig.setType({
                name: 'input-text',
                templateUrl: App.templates('bootstrap', 'input-text.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'input-folder',
                templateUrl: App.templates('bootstrap', 'input-folder.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'input-file',
                templateUrl: App.templates('bootstrap', 'input-file.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'select',
                templateUrl: App.templates('bootstrap', 'select.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'dropdown',
                templateUrl: App.templates('bootstrap', 'dropdown.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'textarea',
                templateUrl: App.templates('bootstrap', 'textarea.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'checkbox',
                templateUrl: App.templates('bootstrap', 'checkbox.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'checkbox-multiple',
                templateUrl: App.templates('bootstrap', 'checkbox-multiple.html'),
                controller: 'BootstrapController'
            });

            formlyConfig.setType({
                name: 'autocomplete',
                templateUrl: App.templates('bootstrap', 'autocomplete.html'),
                controller: 'BootstrapController'
            });

            /**
             * 
             * custom
             */
            formlyConfig.setType({
                name: 'select.project.items',
                templateUrl: App.templates('bootstrap', 'custom/select.project.items.html'),
                controller: 'BootstrapController'
            });

            var unique = 1;
            formlyConfig.setType({
                name: 'repeat',
                templateUrl: App.templates('bootstrap', 'repeat.html'),
                controller: ['$scope', 'ServiceDialog',function($scope, ServiceDialog) {

                    $scope.formOptions = {formState: $scope.formState};
                    $scope.addRow = addRow;
                    $scope.removeRow = removeRow;

                    $scope.copyFields = copyFields;


                    function copyFields(fields) {
                        _fields = angular.copy(fields);
                        addRandomIds(_fields);
                        return _fields;
                    }

                    function removeRow(row, index, $event) {

                        ServiceDialog.confirm('Project', 'Do you want remove this item?', function () {

                            row.splice(index, 1);

                        }, $event);

                    }

                    function addRow() {

                        $scope.model[$scope.options.key] = $scope.model[$scope.options.key] || [];

                        var repeatsection = $scope.model[$scope.options.key];
                        //console.log(repeatsection);
                        var lastSection = repeatsection[repeatsection.length - 1];
                        var newsection = {};
                        if (lastSection) {
                            newsection = angular.copy(lastSection);
                        }
                        for (var i in newsection) {
                            newsection[i] = '';
                        }
                        repeatsection.push(newsection);
                    }

                    function addRandomIds(fields) {
                        unique++;
                        angular.forEach(fields, function(field, index) {
                            if (field.fieldGroup) {
                                addRandomIds(field.fieldGroup);
                                return; // fieldGroups don't need an ID
                            }

                            if (field.templateOptions && field.templateOptions.fields) {
                                addRandomIds(field.templateOptions.fields);
                            }

                            field.id = field.id || (field.key + '_' + index + '_' + unique + getRandomInt(0, 9999));
                        });
                    }

                    function getRandomInt(min, max) {
                        return Math.floor(Math.random() * (max - min)) + min;
                    }
                }]
            });

        }
    )

    .run(function ($rootScope, $timeout) {
        $rootScope.$on('$viewContentLoaded', function () {
            $timeout(function () {
                componentHandler.upgradeDom();
            })
        })
    });