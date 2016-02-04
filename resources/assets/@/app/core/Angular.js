/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

'use strict';

App.angular =

    angular
        .module('app', ['formly'])
        /* 'ngRoute', 'ngAnimate', 'ngMaterial', , 'mdl', 'formlyMaterial', 'formlyBootstrap' */

        .config(function ($controllerProvider) {

            App.register = $controllerProvider.register;
        })

        .filter("sanitize", ['$sce', function($sce) {
            return function(htmlCode){
                return $sce.trustAsHtml(htmlCode);
            }
        }]);