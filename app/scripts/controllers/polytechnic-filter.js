'use strict';

/**
 * @ngdoc function
 * @name cutoffsearchApp.controller:PolytechnicFilterCtrl
 * @description
 * # PolytechnicFilterCtrl
 * Controller of the cutoffsearchApp
 */
angular.module('cutoffsearchApp')
  .controller('PolytechnicFilterCtrl',[ '$scope', '$csDistricts', '$csCourses', '$location',
    function ($scope, $csDistricts, $csCourses, $location ) {

    var init,
        reset;

    reset = function () {
      $scope.polyFilterOptions = {
        seatType: "",
        gender: "",
        category: "",
        distType: "",
        collegeType: "",
        percentage: "",
        districtId: "",
        isTfws: false,
        isPhyHand: false,
        isDefence: false,
        course: "",
        district: ""
      };
    };

    init = function() {
        reset();

        $scope.districts = $csDistricts.get();
        $scope.courses = $csCourses.get();
    };

    $scope.reset = function () {
      reset();
    };

    $scope.search = function () {
      var filter = '';

      //Settin type for filter
      filter = "t=" + $scope.polyFilterOptions.seatType;
      filter = filter + $scope.polyFilterOptions.gender;
      filter = filter + $scope.polyFilterOptions.category;
      filter = filter + $scope.polyFilterOptions.distType;

      //Defence case
      if ( $scope.polyFilterOptions.isDefence ) {
        filter = "t=" + $scope.polyFilterOptions.seatType + 'DEF';
        filter = filter + $scope.polyFilterOptions.distType;
      }

      //District id filter
      filter = filter + "&d=" + $scope.polyFilterOptions.district.districtID;

      //Percentage Case
      if (parseInt($scope.polyFilterOptions.percentage) < 101
          && parseInt($scope.polyFilterOptions.percentage) > 34) {

        filter = filter + "&pr=" + $scope.polyFilterOptions.percentage;
      } else {
        alert("Please enter valid percentage");
        return false;
      }

      //Course Case
      if ($scope.polyFilterOptions.courseName) {
        filter = filter + "&course=" + $scope.polyFilterOptions.courseName.courseName;
      }

      filter = filter + "&tfws=" + $scope.polyFilterOptions.isTfws;
      filter = filter + "&ph=" + $scope.polyFilterOptions.isPhyHand;
      filter = filter + "&cat=" + $scope.polyFilterOptions.category;
      filter = filter + "&dist=" + $scope.polyFilterOptions.district.districtName;

      $location.path("/polytechnic-search-result/" + filter);
    };

    init();

  } ] );
