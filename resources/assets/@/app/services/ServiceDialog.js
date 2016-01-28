/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular


    .factory('ServiceDialog', ['$location', '$mdDialog', '$mdMedia', function ($location, $mdDialog, $mdMedia) {

        var ServiceDialog = {

            /**
             *
             * @param title
             * @param message
             * @param success
             * @param cancel
             */
            confirm: function(title, message, success, cancel) {

                var _confirm = $mdDialog.confirm()
                    .title(title)
                    .textContent(message)
                    //.ariaLabel('Lucky day')
                    //.targetEvent(ev)
                    .ok('Confirm')
                    .cancel('Cancel');

                $mdDialog.show(_confirm).then(function() {

                    if (angular.isFunction(success)) {
                        success.call();
                    }

                }, function() {
                    if (angular.isFunction(cancel)) {
                        cancel.call();
                    }
                });
            },

            /**
             *
             * @param title
             * @param message
             * @param success
             * @param cancel
             */
            alert: function(title, message) {

                var _alert = $mdDialog.confirm()
                    .title(title)
                    .textContent(message)
                    .ok('Close');
                    
                $mdDialog.show(_alert);
            }
        };

        return ServiceDialog;
    }]);
