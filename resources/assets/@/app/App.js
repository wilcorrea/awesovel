/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

'use strict';

window.App = {

    /**
     *
     * @param string
     * @returns {string|XML}
     */
    camelize: function (string, firstLower) {
        return string.replace(/(?:^\w|[A-Z]|\b\w)/g, function (letter, index) {
            return firstLower ? (index == 0 ? letter.toLowerCase() : letter.toUpperCase()) : letter.toUpperCase();
        }).replace(/\s+/g, '');
    },
    /**
     *
     * @param string
     * @returns {XML}
     */
    uncamelize: function (string) {
        return string.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
    },
    /**
     *
     * @param url
     */
    open: function(url) {
      window.location.href = url;
    },
    /**
     *
     * @returns {string}
     */
    guid: function () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    },
    /**
     *
     * @param directive
     * @param file
     *
     * @returns {string}
     */
    templates: function (directive, file) {

        return App.url + '/static/assets/@/app/directives/' + directive + '/templates/' + file
    },
    /**
     *
     * @type screen
     */
    screen: {
        /**
         *
         * @type full
         */
        full: {
            /**
             * Enter in full screen
             *
             * @param element
             */
            enter: function (element) {
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }
            },
            /**
             * Exit full screen
             *
             */
            exit: function () {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }
        }
    }

};