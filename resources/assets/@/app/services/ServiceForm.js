/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular

    .factory('ServiceForm', ['ServiceFile', 'ServiceStorage', function (ServiceFile, ServiceStorage) {

        var ServiceForm = {

            get: function (entity, form) {

                return JSON.parse(ServiceFile.read(ServiceFile.path.join(ServiceStorage._root, 'forms', entity, form + '.json')))
            }
        };

        return ServiceForm;
    }]);
