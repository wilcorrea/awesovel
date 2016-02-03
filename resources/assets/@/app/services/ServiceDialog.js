/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular


    .factory('ServiceDialog', [function () {

        var ServiceDialog = {

            /**
             *
             * @param title
             * @param message
             * @param success
             * @param cancel
             */
            confirm: function(title, message, success, cancel) {

                BootstrapDialog.show({
                    title: title,
                    message: message
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

                BootstrapDialog.show({
                    title: title,
                    message: message.toString()
                });
            }
        };

        return ServiceDialog;
    }]);
