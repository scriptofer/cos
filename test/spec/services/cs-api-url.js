'use strict';

describe('Service: csApiUrl', function () {

  // load the service's module
  beforeEach(module('cutoffsearchApp'));

  // instantiate service
  var csApiUrl;
  beforeEach(inject(function (_csApiUrl_) {
    csApiUrl = _csApiUrl_;
  }));

  xit('should do something', function () {
    expect(!!csApiUrl).toBe(true);
  });

});
