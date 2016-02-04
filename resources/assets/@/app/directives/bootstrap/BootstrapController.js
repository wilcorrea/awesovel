/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */

App.angular

    /**
     * --------------------------------------------------------------------
     * | BootstrapController                                              |
     * --------------------------------------------------------------------
     * |                                                                  |
     * | Controller to support render the screen components               |
     * | Each type supported by api has mapping default behaviours        |
     * |                                                                  |
     * --------------------------------------------------------------------
     */
    .controller('BootstrapController', ['$scope', '$timeout', 'ServiceApi', function ($scope, $timeout, ServiceApi) {

        var vm = this;

        var type = $scope.options.type;

        vm.onchange = function (options, model) {
            //console.log(options, model);
        };

        vm.onfocus = function ($$element, scope) {
            var _active = true;
            try {
                if ($$element.scope().to) {
                    $$element.scope().to._active = _active;
                } else {
                    scope.to._active = _active;
                }
            } catch (e) {

            } finally {

                $scope.$apply();
            }
        };

        vm.onblur = function ($$element, scope) {
            var _active = false;
            try {
                if ($$element.scope().to) {
                    $$element.scope().to._active = _active;
                } else {
                    scope.to._active = _active;
                }
            } catch (e) {

            } finally {

                $scope.$apply();
            }
        };

        switch (type) {

            case 'input-file':
            case 'input-folder':

                vm.update = function (element) {

                    var el = angular.element(element)[0];
                    var resource = el.attributes['resource'].value;

                    switch (resource) {

                        case 'folder':
                            var target = el.attributes['target'].value;
                            var path = element.files.length ? element.files[0].path : '';
                            if (path) {
                                $scope.model[target] = path;
                            }

                            $scope.$apply();
                            break;

                        case 'file':
                            var target = el.attributes['target'].value;
                            var path = element.files.length ? element.files[0].path : '';
                            if (path) {
                                $scope.model[target] = path;
                            }

                            $scope.$apply();
                            break;
                    }
                };
                break;

            case 'dropdown':

                $timeout(function () {
                    componentHandler.upgradeDom();
                }, 1000);

                vm.dropdown = function (option, model, key, to) {
                    model[key] = option.value;
                    to.dropdown = option.label;
                };

                if (angular.isObject($scope.model)) {

                    var option = {
                            value: $scope.model[$scope.options.key],
                            label: ''
                        },
                        items = $scope.options.templateOptions.items;


                    if (angular.isArray(items)) {
                        items.forEach(function (item) {
                            if (item.value === option.value) {
                                option.label = item.label;
                            }
                        });
                    }

                    vm.dropdown(option, $scope.model, $scope.options.key, $scope.options.templateOptions);
                }

                break;

            case 'autocomplete':

                var autocomplete = {
                    /**
                     * ng-model
                     */
                    text: "",
                    /**
                     * @var boolean
                     */
                    visible: false,
                    /**
                     * store to original selected text
                     */
                    original: "",
                    /**
                     * temp storage to search term
                     */
                    searching: "",
                    /**
                     * temp storage to search term
                     */
                    position: -1,
                    /**
                     * @var object TemplateOptions cast
                     */
                    to: $scope.options.templateOptions.autocomplete,
                    /**
                     * @var take records per page
                     */
                    take: 5,
                    /**
                     * @var skip records in pagination
                     */
                    skip: 0,
                    /**
                     * init component
                     */
                    init: function (tries) {

                        tries = !tries ? 0 : tries;

                        //console.log($scope.model[$scope.options.key], tries, document.readyState);

                        if ($scope.model[$scope.options.key] === undefined) {

                            tries = tries + 1;

                            $timeout(function () {
                                if (tries < 10) {
                                    autocomplete.init(tries);
                                }
                            }, 200);

                        } else {

                            var value = $scope.model[$scope.options.key],
                                show = '',
                                search = {};

                            if (value) {

                                search[autocomplete.to.value] = value;

                                autocomplete._search(search, function (response) {

                                    var collection = response.collection,
                                        selected = {};

                                    if (angular.isArray(collection)) {

                                        selected = collection[0];

                                        show = selected[autocomplete.to.show];

                                        autocomplete.original = show;
                                        autocomplete.text = show;
                                    }
                                });
                            }
                        }
                    },
                    /**
                     *
                     * @param typed
                     * @param callback
                     * @private
                     */
                    _search: function (typed, callback) {

                        var to = autocomplete.to,
                            params = {},
                            search = {};

                        if (typeof typed === 'string') {

                            autocomplete.searching = typed;

                            if (angular.isArray(to.search)) {
                                to.search.forEach(function (s) {
                                    search[s] = typed;
                                });
                            }
                        } else if (typed) {

                            search = typed;
                        }

                        console.log(autocomplete.take, autocomplete.skip, search);

                        var pagination = App.pagination(autocomplete.take, autocomplete.skip, search);

                        ServiceApi.collection(App.token, to.module, to.entity, to.recover, params, pagination,
                            function (status, response) {

                                if (response.data.result) {

                                    autocomplete.collection = response.data.result.collection;
                                    autocomplete.total = response.data.result.total;
                                    autocomplete.last = Math.ceil(response.data.result.total / autocomplete.take);

                                    //autocomplete.visible = true;
                                    if (angular.isFunction(callback)) {
                                        callback.call(this, response.data.result);
                                    }
                                }
                            });

                    },
                    /**
                     *
                     */
                    keyup: function ($event) {

                        //console.log($event.keyCode);

                        switch ($event.keyCode) {

                            /* ESC */
                            case 27:

                                autocomplete.hide();
                                break;

                            /* ARROW UP */
                            case 38:

                                autocomplete.visible = true;

                                autocomplete.arrow(-1);
                                break;

                            /* ARROW DOWN */
                            case 40:

                                autocomplete.visible = true;

                                autocomplete.arrow(1);
                                break;

                            /* ARROW RIGHT */
                            case 39:

                                if (autocomplete.visible && autocomplete.position > -1) {

                                    var search = false,
                                        skip = ((autocomplete.skip / autocomplete.take) + 1) * autocomplete.take,
                                        last = (autocomplete.last - 1) * autocomplete.take;

                                    console.log('arrow-right', skip, last);

                                    if (skip > last) {
                                        skip = last;
                                    } else {
                                        search = true;
                                    }

                                    autocomplete.skip = skip;

                                    if (search) {
                                        autocomplete._search(autocomplete.searching, function () {
                                            autocomplete.position = -1;
                                            autocomplete.arrow(1);
                                        });
                                    }

                                    autocomplete.prevent($event.currentTarget);
                                }
                                break;

                            /* ARROW LEFT */
                            case 37:

                                if (autocomplete.visible && autocomplete.position > -1) {

                                    var search = false,
                                        skip = autocomplete.skip - autocomplete.take;

                                    if (skip < 0) {
                                        skip = 0;
                                    } else {
                                        search = true;
                                    }

                                    autocomplete.skip = skip;

                                    if (search) {
                                        autocomplete._search(autocomplete.searching, function () {
                                            autocomplete.position = -1;
                                            autocomplete.arrow(1);
                                        });
                                    }

                                    autocomplete.prevent($event.currentTarget);
                                }
                                break;

                            /* ENTER */
                            case 13:

                                if (angular.isArray(autocomplete.collection)) {

                                    autocomplete.collection.forEach(function (c) {
                                        if (c.selected) {
                                            autocomplete.select(c);
                                        }
                                    });
                                }
                                break;

                            default:

                                autocomplete.skip = 0;

                                autocomplete.searching = autocomplete.text;

                                autocomplete._search(autocomplete.searching);
                                break;
                        }
                    },
                    /**
                     *
                     * @param arrow
                     */
                    arrow: function (factor) {

                        var _arrow = function (arrow) {

                            var index = (autocomplete.position + arrow),
                                min = 0,
                                max = autocomplete.collection.length - 1;

                            if (index < min) {
                                index = min;
                            } else if (index > max) {
                                index = max;
                            }

                            autocomplete.position = index;

                            //console.log(index, min, max);

                            autocomplete.collection.forEach(function (c) {
                                c.selected = false;
                            });

                            if (autocomplete.collection[index]) {
                                autocomplete.collection[index].selected = true;
                            }
                        };

                        if (angular.isArray(autocomplete.collection)) {

                            if (autocomplete.collection.length) {
                                _arrow.call(this, factor);
                            } else {
                                autocomplete._search(autocomplete.searching, function () {
                                    _arrow.call(this, factor);
                                });
                            }
                        }
                    },
                    /**
                     *
                     * @param model
                     * @param selected
                     */
                    select: function (selected) {

                        autocomplete.visible = false;

                        var show = autocomplete.to.show,
                            value = autocomplete.to.value;

                        $scope.model[$scope.options.key] = selected[value];

                        autocomplete.searching = "";
                        autocomplete.original = selected[show];
                        autocomplete.text = selected[show];
                        autocomplete.position = -1;

                        autocomplete.collection = [];
                    },
                    /**
                     *
                     */
                    focus: function () {

                        autocomplete.visible = true;
                        autocomplete.position = -1;

                        if (autocomplete.searching) {

                            autocomplete.text = autocomplete.searching;
                        } else {

                            autocomplete._search("");

                            autocomplete.original = autocomplete.text;
                        }
                    },
                    /**
                     *
                     */
                    blur: function () {

                        $timeout(function () {
                            autocomplete.hide();
                        }, 250);

                        if (autocomplete.searching) {
                            autocomplete.text = autocomplete.original;
                        }
                    },
                    /**
                     *
                     */
                    hide: function () {

                        autocomplete.position = -1;
                        autocomplete.visible = false;
                    },
                    /**
                     *
                     */
                    add: function (text) {
                        alert(text);
                        // call api,
                        // save the item,
                        // get the id and put in the model
                    },
                    /**
                     *
                     * @param row
                     * @returns {*}
                     */
                    item: function (row) {

                        function preg_quote(str) {
                            return (str + '').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
                        }

                        var show = row[autocomplete.to.show],
                            search = autocomplete.searching;

                        if (search) {
                            show = show.replace(new RegExp("(" + preg_quote(search) + ")", 'gi'), "<i>$1</i>");
                        }
                        return show;
                    },
                    /**
                     *
                     * @param target
                     */
                    prevent: function(target) {

                        var e = angular.element(target)[0];

                        if (autocomplete.text) {

                            if (e.createTextRange) {
                                var range = e.createTextRange();
                                range.move('character', autocomplete.text.length);
                                range.select();
                            } else {
                                if (e.setSelectionRange) {
                                    e.setSelectionRange(autocomplete.text.length, autocomplete.text.length);
                                }
                            }
                        }
                    }
                };

                $scope.autocomplete = autocomplete;

                $scope.autocomplete.init();
        }


        $scope.vm = vm;
    }]);