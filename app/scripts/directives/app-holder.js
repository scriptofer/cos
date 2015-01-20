'use strict';

/**
 * @ngdoc directive
 * @name cutoffsearchApp.directive:appHolder
 * @description
 * # appHolder
 */
angular.module('cutoffsearchApp')
  .directive('appHolder', function () {
    return {
      templateUrl: 'views/app-holder.html',
      restrict: 'E',
      replace: true,
      link: function postLink(scope, element, attrs) {
        //element.text('this is the appHolder directive');
      }
    };
  });
