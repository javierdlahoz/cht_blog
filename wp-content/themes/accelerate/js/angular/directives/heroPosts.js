window.angularApp
  .directive('heroPosts', function() {
    return {
      restrict: 'E',
      scope: {
        mainPost: '=mainPost',
        secondaryPost: '=secondaryPost',
        thirdPost: '=thirdPost'
      },
      templateUrl: '/wp-content/themes/accelerate/js/angular/directives/hero-posts.html',
      controller: ['$scope', '$sce', function HeroPostsDirectiveController($scope, $sce) {
        if ($scope.mainPost) {
          $scope.mainPost.title.rendered = $sce.trustAsHtml($scope.mainPost.title.rendered);
          $scope.mainPost.excerpt.rendered = $sce.trustAsHtml($scope.mainPost.excerpt.rendered);
        }
        if ($scope.secondaryPost) {
          $scope.secondaryPost.title.rendered = $sce.trustAsHtml($scope.secondaryPost.title.rendered);
          $scope.secondaryPost.excerpt.rendered = $sce.trustAsHtml($scope.secondaryPost.excerpt.rendered);
        }
        if ($scope.thirdPost) {
          $scope.thirdPost.title.rendered = $sce.trustAsHtml($scope.thirdPost.title.rendered);
          $scope.thirdPost.excerpt.rendered = $sce.trustAsHtml($scope.thirdPost.excerpt.rendered);
        }
      }]
    };
  });