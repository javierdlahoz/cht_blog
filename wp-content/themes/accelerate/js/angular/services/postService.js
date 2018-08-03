window.angularApp.factory('PostService', PostService);

function PostService($http, $sce)
{
  var baseUrl = '/wp-json/wp/v2/posts';
  var self = this;
  self.sce = $sce;

  return {
    getLatestPost: function(cb) {
      $http({
        url: baseUrl + '&per_page=1',
        method: 'GET',
        cache: true
      }).then(function (response) {
        response.data[0].first_image = getFirstImageFromContent(response.data[0].content.rendered);
        return cb(response.data[0]);
      });
    },

    getPosts: function(query = {}, cb) {
      $http({
        url: baseUrl,
        method: 'GET',
        params: query,
        cache: true
      }).then(function (response) {
        for(var i = 0; i < response.data.length; i++) {
          response.data[i].first_image = getFirstImageFromContent(response.data[i].content.rendered);
        }

        return cb(response.data);
      });
    }
  }
}

getFirstImageFromContent = function(content) {
  var elem = document.createElement("div");
  elem.innerHTML = content;

  var images = elem.getElementsByTagName("img");

  if (images && images[0] &&
    images[0].src.indexOf('http://charityhowto.com/') < 0 &&
    images[0].src.indexOf('legacy.charityhowto.com') < 0 &&
    images[0].src.indexOf('www.charityhowto.com') < 0
  )
  {
    var src = images[0].src;
    elem.remove();
    return src;
  } else {
    return 'http://blog.charityhowto.com/wp-content/uploads/2018/06/blog-2355684_960_720.jpg';
  }
}