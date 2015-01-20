'use strict';

/**
 * @ngdoc service
 * @name cutoffsearchApp.csApiUrl
 * @description
 * # csApiUrl
 * Service in the cutoffsearchApp.
 */
angular.module('cutoffsearchApp')
  .service('$csApiUrl', function csApiUrl() {
    // AngularJS will instantiate a singleton by calling "new" on this function
    this.districtApi = 'api/college/districts/format/json';

    this.districtApi = 'mock_json/districts.json';
    this.courseApi = 'mock_json/course.json';
    this.polySearchApi = 'mock_json/poly-search.json';
  });
