'use strict';

describe('Controller: PolytechnicSearchResultCtrl', function () {

  // load the controller's module
  beforeEach(module('cutoffsearchApp'));

  var PolytechnicSearchResultCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    PolytechnicSearchResultCtrl = $controller('PolytechnicSearchResultCtrl', {
      $scope: scope
    });
  }));

  xit('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
