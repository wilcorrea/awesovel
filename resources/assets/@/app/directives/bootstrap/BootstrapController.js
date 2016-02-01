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
    .controller('BootstrapController', ['$scope', '$timeout', function ($scope, $timeout) {

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

            /**
             * --------------------------------------------------------------------
             * | Input File                                                       |
             * --------------------------------------------------------------------
             * |                                                                  |
             * | The component input[type="text"] is adapted to get the path      |
             * |   what is taken by default input to this (input[type="file"]     |
             * |                                                                  |
             * --------------------------------------------------------------------
             */
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

                $timeout(function() {
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

                /**
                 * --------------------------------------------------------------------
                 * | Autocomplete (Just a Demo by the way)                            |
                 * --------------------------------------------------------------------
                 * |                                                                  |
                 * | The component is a widget of Angular Material Library and is     |
                 * |   being adapted to be used together with bootstrap components    |
                 * |                                                                  |
                 * --------------------------------------------------------------------
                 */
                var self = this;

                self.simulateQuery = false;
                self.isDisabled = false;
                // list of `state` value/display objects
                self.querySearch = querySearch;
                self.selectedItemChange = selectedItemChange;
                self.searchTextChange = searchTextChange;
                self.newState = newState;

                var _allStates = [{"value": "alabama", "display": "Alabama"}, {
                    "value": "alaska",
                    "display": "Alaska"
                }, {"value": "arizona", "display": "Arizona"}, {
                    "value": "arkansas",
                    "display": "Arkansas"
                }, {"value": "california", "display": "California"}, {
                    "value": "colorado",
                    "display": "Colorado"
                }, {"value": "connecticut", "display": "Connecticut"}, {
                    "value": "delaware",
                    "display": "Delaware"
                }, {"value": "florida", "display": "Florida"}, {"value": "georgia", "display": "Georgia"}, {
                    "value": "hawaii",
                    "display": "Hawaii"
                }, {"value": "idaho", "display": "Idaho"}, {"value": "illinois", "display": "Illinois"}, {
                    "value": "indiana",
                    "display": "Indiana"
                }, {"value": "iowa", "display": "Iowa"}, {"value": "kansas", "display": "Kansas"}, {
                    "value": "kentucky",
                    "display": "Kentucky"
                }, {"value": "louisiana", "display": "Louisiana"}, {"value": "maine", "display": "Maine"}, {
                    "value": "maryland",
                    "display": "Maryland"
                }, {"value": "massachusetts", "display": "Massachusetts"}, {
                    "value": "michigan",
                    "display": "Michigan"
                }, {"value": "minnesota", "display": "Minnesota"}, {
                    "value": "mississippi",
                    "display": "Mississippi"
                }, {"value": "missouri", "display": "Missouri"}, {
                    "value": "montana",
                    "display": "Montana"
                }, {"value": "nebraska", "display": "Nebraska"}, {
                    "value": "nevada",
                    "display": "Nevada"
                }, {"value": "new_hampshire", "display": "New Hampshire"}, {
                    "value": "new_jersey",
                    "display": "New Jersey"
                }, {"value": "new_mexico", "display": "New Mexico"}, {
                    "value": "new_york",
                    "display": "New York"
                }, {"value": "north_carolina", "display": "North Carolina"}, {
                    "value": "north_dakota",
                    "display": "North Dakota"
                }, {"value": "ohio", "display": "Ohio"}, {"value": "oklahoma", "display": "Oklahoma"}, {
                    "value": "oregon",
                    "display": "Oregon"
                }, {"value": "pennsylvania", "display": "Pennsylvania"}, {
                    "value": "rhode_island",
                    "display": "Rhode Island"
                }, {"value": "south_carolina", "display": "South Carolina"}, {
                    "value": "south_dakota",
                    "display": "South Dakota"
                }, {"value": "tennessee", "display": "Tennessee"}, {"value": "texas", "display": "Texas"}, {
                    "value": "utah",
                    "display": "Utah"
                }, {"value": "vermont", "display": "Vermont"}, {
                    "value": "virginia",
                    "display": "Virginia"
                }, {"value": "washington", "display": "Washington"}, {
                    "value": "west_virginia",
                    "display": "West Virginia"
                }, {"value": "wisconsin", "display": "Wisconsin"}, {"value": "wyoming", "display": "Wyoming"}];


                _allStates.forEach(function (_state) {

                    if (_state.value === $scope.model[$scope.options.key]) {

                        self.searchText = _state.display;
                    }
                });

                function newState(state) {

                    var value = state.toLowerCase().replace(' ', '_');

                    _allStates.push({
                        "value": value, "display": state
                    });

                    self.states = loadAll();

                    console.log(self.states);

                    self.searchText = state;

                    //$scope.$apply();
                }

                    // ******************************
                    // Internal methods
                    // ******************************
                /**
                 * Search for states... use $timeout to simulate
                 * remote dataservice call.
                 */
                function querySearch(query) {
                    var results = query ? self.states.filter(createFilterFor(query)) : self.states,
                        deferred;
                    if (false && self.simulateQuery) {
                        deferred = $q.defer();
                        $timeout(function () {
                            deferred.resolve(results);
                        }, Math.random() * 1000, false);
                        return deferred.promise;
                    } else {
                        return results;
                    }
                }

                function searchTextChange(text) {
                    console.info('Text changed to ' + text);
                    //document.querySelector('md-virtual-repeat-container').classList.remove('ng-hide');
                }

                function selectedItemChange(item) {

                    console.info('Item changed to ' + JSON.stringify(item));

                    if (item && item.value.length) {
                        $scope.model[$scope.options.key] = item.value;
                    }
                }

                /**
                 * Build `states` list of key/value pairs
                 */
                function loadAll() {

                    return _allStates;
                }

                /**
                 * Create filter function for a query string
                 */
                function createFilterFor(query) {
                    var lowercaseQuery = angular.lowercase(query);
                    return function filterFn(state) {
                        return (state.value.indexOf(lowercaseQuery) === 0);
                    };
                }


                self.states = loadAll();

                $scope.self = self;

                break;
        }

        $scope.vm = vm;
    }]);