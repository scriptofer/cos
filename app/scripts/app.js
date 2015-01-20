'use strict';

/**
 * @ngdoc overview
 * @name cutoffsearchApp
 * @description
 * # cutoffsearchApp
 *
 * Main module of the application.
 */
angular
  .module('cutoffsearchApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl'
      })
      .when('/polytechnic-filter', {
        templateUrl: 'views/polytechnic-filter.html',
        controller: 'PolytechnicFilterCtrl'
      })
      .when('/polytechnic-search-result/:filters', {
        templateUrl: 'views/polytechnic-search-result.html',
        controller: 'PolytechnicSearchResultCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
