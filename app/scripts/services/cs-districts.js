'use strict';

/**
 * @ngdoc service
 * @name cutoffsearchApp.csDistricts
 * @description
 * # csDistricts
 * Factory in the cutoffsearchApp.
 */
angular.module('cutoffsearchApp')
  .factory('$csDistricts',[ '$csApiUrl', '$resource',
    function ( $csApiUrl, $resource ) {

    var districtApiUrl;

    districtApiUrl = $csApiUrl.districtApi;

    return $resource( districtApiUrl, {}, {
      get: {method:'GET', isArray:true}
    });
  } ] );
