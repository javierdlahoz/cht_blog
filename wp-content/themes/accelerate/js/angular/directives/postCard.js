window.angularApp
  .directive('postCard', function() {
    return {
      restrict: 'E',
      scope: {
        post: '=post',
        colClass: '=?colClass'
      },
      templateUrl: '/wp-content/themes/accelerate/js/angular/directives/post-card.html',
      controller: ['$scope', '$sce', function PostCardDirectiveController($scope, $sce) {
        if ($scope.post) {
          $scope.post.title.rendered = $sce.trustAsHtml($scope.post.title.rendered);
          $scope.post.excerpt.rendered = $sce.trustAsHtml($scope.post.excerpt.rendered);
        }
      }]
    };
  });