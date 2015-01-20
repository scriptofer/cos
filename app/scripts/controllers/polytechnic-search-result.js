'use strict';

/**
 * @ngdoc function
 * @name cutoffsearchApp.controller:PolytechnicSearchResultCtrl
 * @description
 * # PolytechnicSearchResultCtrl
 * Controller of the cutoffsearchApp
 */
angular.module('cutoffsearchApp')
  .controller('PolytechnicSearchResultCtrl',[ '$scope', '$polySearch',
    function ($scope, $polySearch) {

    var init;

    init = function () {
      $scope.searchResult = $polySearch.get();
    };

    init();
  } ] );
