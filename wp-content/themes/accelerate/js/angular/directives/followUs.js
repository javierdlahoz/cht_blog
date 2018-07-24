window.angularApp
  .controller('Controller', ['$scope', function($scope) {

  }])
  .directive('followUs', function() {
    return {
      restrict: 'E',
      templateUrl: '/wp-content/themes/accelerate/js/angular/directives/follow-us.html'
    };
  });