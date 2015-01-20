'use strict';

/**
 * @ngdoc service
 * @name cutoffsearchApp.csCourses
 * @description
 * # csCourses
 * Factory in the cutoffsearchApp.
 */
angular.module('cutoffsearchApp')
  .factory('$csCourses',[ '$csApiUrl', '$resource', function ( $csApiUrl, $resource ) {

    var courseApiUrl;

    courseApiUrl = $csApiUrl.courseApi;

    return $resource( courseApiUrl, {}, {
      get: {method:'GET', isArray:true}
    });

  } ] );
