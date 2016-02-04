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
             * @param action
             */
            confirm: function(title, message, success, action) {

                BootstrapDialog.show({
                    title: title,
                    message: message,
                    buttons: [{
                        label: success ? success : 'Confirm',
                        cssClass: 'btn-primary',
                        action: function(self) {
                            try {
                                action.call(this, self);
                            } catch (e) {

                            }
                        }
                    }]
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
                    message: message,
                    buttons: [{
                        label: 'Close',
                        cssClass: 'btn-primary',
                        action: function(self){
                            self.close();
                        }
                    }]
                });
            }
        };

        return ServiceDialog;
    }]);
