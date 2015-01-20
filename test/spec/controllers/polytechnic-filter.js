'use strict';

describe('Controller: PolytechnicFilterCtrl', function () {

  // load the controller's module
  beforeEach(module('cutoffsearchApp'));

  var PolytechnicFilterCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    PolytechnicFilterCtrl = $controller('PolytechnicFilterCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
