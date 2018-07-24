window.angularApp
  .controller('Controller', ['$scope', function($scope) {

  }])
  .directive('loading', function() {
    return {
      restrict: 'E',
      template: '<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>'
    };
  });