window.angularApp.controller('NavigationController', NavigationController);

function NavigationController($scope, $sce, PostService) {
  var vm = this;
  vm.loading = false;

  vm.initialize = function($nexPostId, $prevPostId) {
    vm.getNavigationPosts($nexPostId, $prevPostId);
  }

  vm.getNavigationPosts = function($nexPostId, $prevPostId) {
    var included = [];
    if ($nexPostId) included.push($nexPostId);
    if ($prevPostId) included.push($prevPostId);

    var query = {per_page: 2, 'include[]': included};
    vm.loading = true;
    PostService.getPosts(query, function (posts) {
      vm.posts = posts;
      vm.loading = false;
    })
  }
}