/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular

    .factory('ServiceProvider', function () {

        var ServiceProvider = {
            /**
             * @type
             */
            data: {

            },
            /**
             *
             * @param index
             * @returns {*|XMLList|XML}
             */
            get: function(index) {

                var data = angular.copy(ServiceProvider.data[index]);

                ServiceProvider.data[index] = null;

                return data;
            },
            /**
             *
             * @param index
             * @param data
             */
            set: function(index, data) {
                ServiceProvider.data[index] = data;
            }
        };

        return ServiceProvider;
    });
