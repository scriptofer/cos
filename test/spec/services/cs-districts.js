'use strict';

describe('Service: csDistricts', function () {

  // load the service's module
  beforeEach(module('cutoffsearchApp'));

  // instantiate service
  var csDistricts;
  beforeEach(inject(function (_csDistricts_) {
    csDistricts = _csDistricts_;
  }));

  it('should do something', function () {
    expect(!!csDistricts).toBe(true);
  });

});
