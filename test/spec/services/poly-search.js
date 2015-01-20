'use strict';

describe('Service: polySearch', function () {

  // load the service's module
  beforeEach(module('cutoffsearchApp'));

  // instantiate service
  var polySearch;
  beforeEach(inject(function (_polySearch_) {
    polySearch = _polySearch_;
  }));

  xit('should do something', function () {
    expect(!!polySearch).toBe(true);
  });

});
