'use strict';

/**
 * @ngdoc service
 * @name cutoffsearchApp.polySearch
 * @description
 * # polySearch
 * Factory in the cutoffsearchApp.
 */
angular.module('cutoffsearchApp')
  .factory('$polySearch',[ '$csApiUrl', '$resource',
    function ( $csApiUrl, $resource ) {

      var polySearchApiUrl;

      polySearchApiUrl = $csApiUrl.polySearchApi;

      return $resource( polySearchApiUrl, {}, {
        get: {method:'GET', isArray:true}
      });

  } ] );
