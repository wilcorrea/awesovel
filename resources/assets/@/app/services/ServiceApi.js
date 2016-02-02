/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular

    .factory('ServiceApi', ['$http', function ($http) {

        var ServiceApi = {

            resolve: function (token, type, module, entity, operation, data, callback) {

                //data._token = token;

                switch (type) {

                    case 'frontend':
                        window.location.href = App.url + '/app/' + App.uncamelize(module) + '/' + App.uncamelize(entity) + '/' + App.uncamelize(operation);
                        //console.log(App.url + '/app/' + App.uncamelize(module) + '/' + App.uncamelize(entity) + '/' + App.uncamelize(_action.id));
                        break;

                    case 'backend':

                        var request = {
                            method: 'POST',
                            url: App.url + '/api/0.0.0.1/' + App.uncamelize(module) + '/' + App.uncamelize(entity) + '/' + App.uncamelize(operation),
                            headers: {
                                'X-CSRF-Token': token
                            },
                            data: data
                        };

                        console.log(request);

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