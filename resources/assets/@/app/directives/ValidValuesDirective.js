/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App
    .angular

    .directive('validValues', function ($parse) {
        return {
            scope: {
                validValues: '=acceptValues'
            },
            link: function (scope, elm, attrs) {

                elm.bind('keypress', function (e) {
                    var char = String.fromCharCode(e.which || e.charCode || e.keyCode), matches = [];

                    angular.forEach(scope.validValues, function (value, key) {
                        if (char === value) matches.push(char);
                    }, matches);

                    if (matches.length == 0) {
                        e.preventDefault();
                        return false;
                    }
                });
            }
        }
    });