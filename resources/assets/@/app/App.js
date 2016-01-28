/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

'use strict';

window.App = {

    /**
     *
     * @param str
     * @returns {string|XML}
     */
    camelize: function (str) {
        return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function (letter, index) {
            return /*index == 0 ? letter.toLowerCase() :*/ letter.toUpperCase();
        }).replace(/\s+/g, '');
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