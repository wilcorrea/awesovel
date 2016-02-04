/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular

    .factory('ServiceApi', ['$http', function ($http) {

        var ServiceApi = {
            /**
             *
             * @param root
             * @param pieces
             * @returns {string}
             */
            url: function(root, pieces) {

                return  App.url + '/' + root + '/' + $.map(pieces, function(piece) {
                        return App.uncamelize(piece);
                    }).join('/');
            },
            /**
             *
             * @returns {Array}
             */
            route: function () {
                var path = window.location.href.replace(App.url + '/', '');
                if (path.substring(path.length - 1) === '/') {
                    path = path.substring(0, path.length - 1);
                }
                return path.split('/');
            },
            /**
             *
             * @param token
             * @param type
             * @param module
             * @param entity
             * @param operation
             * @param data
             * @param collection
             * @param callback
             */
            resolve: function (token, type, module, entity, operation, data, collection, callback) {

                //data._token = token;

                switch (type) {

                    case 'frontend':

                        var url = ServiceApi.url('app', [module, entity, operation.action]),
                            parameters = [];

                        if (angular.isArray(operation.parameters)) {
                            operation.parameters.forEach(function (parameter) {
                                parameters.push(data[parameter]);
                            });
                        }

                        url = url + '/' + parameters.join('/');

                        window.location.href = url;
                        break;

                    case 'backend':

                        var request = {
                            method: 'POST',
                            url: ServiceApi.url('api/head', [module, entity, operation.action]),
                            headers: {
                                'X-CSRF-Token': token
                            },
                            data: collection
                        };

                        $http(request).then(
                            /**
                             * success
                             */
                            function (response) {
                                ServiceApi._then(true, callback, response);
                            },
                            /**
                             * error
                             */
                            function (response) {
                                ServiceApi._then(false, callback, response);
                            });

                        break;
                }
            },
            /**
             *
             * @param token
             * @param module
             * @param entity
             * @param recover
             * @param parameters
             * @param pagination
             * @param callback
             */
            collection: function (token, module, entity, recover, parameters, pagination, callback) {

                var route = ServiceApi.route();

                for(var i = 0; i < 4; i++) {
                    route.shift();
                }

                pagination.search = pagination.search ? pagination.search : {};

                route.forEach(function (route, i) {
                    if (parameters[i]) {
                        pagination.search[parameters[i]] = route;
                    }
                });

                var request = {
                    method: 'POST',
                    url: ServiceApi.url('api/head', [module, entity, recover]),
                    headers: {
                        'X-CSRF-Token': token
                    },
                    data: pagination
                };

                $http(request).then(
                    /**
                     * success
                     */
                    function (response) {
                        ServiceApi._then(true, callback, response);
                    },
                    /**
                     * error
                     */
                    function (response) {
                        ServiceApi._then(false, callback, response);
                    });
            },
            /**
             *
             * @param status
             * @param callback
             * @param response
             *
             * @private
             */
            _then: function (status, callback, response) {
                try {
                    if (angular.isFunction(callback)) {

                        callback.call(this, status, response);
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        };

        return ServiceApi;
    }]);