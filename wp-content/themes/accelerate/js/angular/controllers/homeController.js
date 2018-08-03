window.angularApp.controller('HomeController', HomeController);

function HomeController($scope, $sce, PostService) {
  var vm = this;
  vm.loading = false;

  vm.initialize = function() {
    vm.getHomePosts();
  }

  vm.getHomePosts = function() {
    vm.loading = true;
    PostService.getPosts({per_page: 39, page: 1, orderby: 'date'}, function (posts) {
      vm.latestPost = posts[0];
      vm.secondPost = posts[1];
      vm.thirdPost = posts[2];
      vm.posts = posts.slice(3, posts.length);
      vm.loading = false;
    })
  }
}