'use strict';

/**
 * @ngdoc function
 * @name cutoffsearchApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the cutoffsearchApp
 */
angular.module('cutoffsearchApp')
  .controller('AboutCtrl', function($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];

    $scope.users = [
      { name: "Moroni", age: 50 },
      { name: "Tiancum", age: 43 },
      { name: "Jacob", age: 27 },
      { name: "Nephi", age: 29 },
      { name: "Enos", age: 34 }
    ];
  });
