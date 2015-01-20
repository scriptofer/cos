'use strict';

/**
 * @ngdoc directive
 * @name cutoffsearchApp.directive:navigation
 * @description
 * # navigation
 */
angular.module('cutoffsearchApp')
  .directive('navigation', function () {
    return {
      templateUrl: 'views/navigation.html',
      restrict: 'E',
      replace: true,
      link: function postLink(scope, element, attrs) {
      }
    };
  });
