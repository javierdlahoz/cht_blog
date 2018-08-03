window.angularApp.controller('ArchiveController', ArchiveController);

function ArchiveController($scope, $sce, PostService) {
  var vm = this;
  vm.loading = false;

  vm.initialize = function(termId) {
    vm.getArchivePosts(termId);
  }

  vm.getArchivePosts = function(termId) {
    var categories = [termId];
    vm.loading = true;
    PostService.getPosts({per_page: 39, page: 1, orderby: 'date', categories: categories}, function (posts) {
      if (posts.length < 1) {
        PostService.getPosts({per_page: 39, page: 1, orderby: 'date', tags: categories}, function (posts) {
          vm.preparePosts(posts);
        });
      } else {
        vm.preparePosts(posts);
      }
    })
  }

  vm.preparePosts = function(posts) {
    vm.latestPost = posts[0];
    vm.secondPost = posts[1];
    vm.thirdPost = posts[2];
    vm.posts = posts.slice(3, posts.length);
    vm.loading = false;
  }
}