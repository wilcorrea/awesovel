/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

'use strict';

App.angular =
    angular.module('app', ['ngRoute', 'ngAnimate', 'ngMaterial', 'formly'
        /*, 'mdl'*//*, 'formlyMaterial'*//*, 'formlyBootstrap'*/]);

/*
App.angular

    .config(['$routeProvider', '$locationProvider',

        function ($routeProvider, $locationProvider) {

            $routeProvider

                // Home
                .when('/', {
                    templateUrl: 'resources/views/home.html',
                    controller: function () {

                    }
                })

                // Home
                .when('/home', {
                    templateUrl: 'resources/views/home.html',
                    controller: function () {

                    }
                })

                // Catch All
                .when('/:route*', {
                    template: function (params) {

                        var
                            route = params.route.split('/'),
                            service = route[0],
                            controller = '',
                            template = '';

                        switch (service) {

                            case 'app':

                                controller = App.camelize(route[1]) + App.camelize(route[2]) + 'Controller';

                                template =
                                    '<div ng-controller="' + controller + '">' +
                                    '<ng-include src="template" onload="onload()"></ng-include>' +
                                    '</div>'

                                break;
                        }

                        return template;
                    },
                    controller: 'TemplateCtrl'
                })

            //$locationProvider.html5Mode(true);
        }
    ])


    .controller("TemplateCtrl", ['$scope', '$routeParams', 'ServiceProvider', 'ServiceStorage', function ($scope, $routeParams, ServiceProvider, ServiceStorage) {

        var
            route = $routeParams.route.split('/'),
            service = route[0],
            controller = route[1] ? route[1] : '',
            layout = route[2] ? route[2] : '',
            id = route[3] ? route[3] : '',
            template = '';

        switch (service) {

            case 'app':

                template = 'resources/views/' + controller + '/' + layout + '.html';

                if (id) {

                    ServiceProvider.set(controller, ServiceStorage.read(controller, id));
                }
                break;
        }

        $scope.template = template;
    }]);
 */