'use strict';

describe('Service: csCourses', function () {

  // load the service's module
  beforeEach(module('cutoffsearchApp'));

  // instantiate service
  var csCourses;
  beforeEach(inject(function (_csCourses_) {
    csCourses = _csCourses_;
  }));

  xit('should do something', function () {
    expect(!!csCourses).toBe(true);
  });

});
