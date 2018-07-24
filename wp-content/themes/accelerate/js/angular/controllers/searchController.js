window.angularApp.controller('SearchController', SearchController);

function SearchController($scope, $sce, PostService) {
  var vm = this;
  vm.loading = false;

  vm.initialize = function() {
    vm.query = jQuery.urlParam('s');
    vm.getHomePosts();
  }

  vm.getHomePosts = function() {
    vm.loading = true;
    PostService.getPosts({per_page: 30, page: 1, orderby: 'date', search: vm.query}, function (posts) {
      vm.posts = posts;
      vm.loading = false;
    })
  }
}