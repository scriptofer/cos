'use strict';

describe('Directive: appHolder', function () {

  // load the directive's module
  beforeEach(module('cutoffsearchApp'));

  var element,
    scope;

  beforeEach(inject(function ($rootScope) {
    scope = $rootScope.$new();
  }));

  xit('should make hidden element visible', inject(function ($compile) {
    element = angular.element('<app-holder></app-holder>');
    element = $compile(element)(scope);
    expect(element.text()).toBe('this is the appHolder directive');
  }));
});
