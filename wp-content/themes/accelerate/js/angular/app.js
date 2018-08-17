window.angularApp = angular.module('chtBlog', []);

jQuery.urlParam = function (name) {
  var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
  if (results == null) {
    return null;
  }
  else {
    return decodeURI(results[1]) || 0;
  }
}

if (getCookie('showpoupemail') == null) {
  document.cookie = "showpoupemail=show; max-age=60; path=/";
}

jQuery(document).ready(function ($) {

  jQuery(window).scroll(function () {
    if (getCookie('showpoupemail') == 'show' && $(document).scrollTop() > 500 && $("#emailModalForm").attr("displayed") === "false") {
      jQuery('#emailModalForm').modal('show');
      jQuery("#emailModalForm").attr("displayed", "true");
    }
  });

  jQuery("#dismiss-email-modal").on("click", function () {
    notShowModalAgain();
  })
});

function submitEmail(token) {
  jQuery("#modal-captions").hide();
  jQuery("#modal-messages").show();

  // jQuery.ajax('http://app.charityhowto.com:8080/public/subscribe-from-blog', {
  jQuery.ajax('https://www.charityhowto.com/subscribe-from-blog', {
    type: 'POST',
    xhrFields: {withCredentials: true},
    data: {
      token: token,
      email: jQuery("#subscriber-email").val()
    },
    success: function () {
      notShowModalAgain();
      jQuery("#modal-processing").hide();
      jQuery("#subscribe-email-form").hide();

      jQuery("#thank-you-modal").show();
      setTimeout(function () {
        jQuery("#emailModalForm").modal('toggle');
      }, 6000);
    },
    error: function () {
      jQuery("#modal-processing").hide();
      jQuery("#error-modal").show();
    }
  });
}

function notShowModalAgain() {
  handleSkipEmailModal();
}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
  else return null;
}

function handleSkipEmailModal() {
  var skipCounter = jQuery.cookie('skip_modal_counter') || 0;
  skipCounter++;

  switch (skipCounter) {
    case 1:
      setEmailModalAsHidden(1);
      break;
    case 2:
      setEmailModalAsHidden(7);
      break;
    case 3:
      setEmailModalAsHidden(30);
      break;
    default:
      setEmailModalAsHidden(30);
      break;
  }
  jQuery.cookie('skip_modal_counter', skipCounter, {path: '/'});
}

function setEmailModalAsHidden(expirationDays) {
  jQuery.cookie('showpoupemail', 'notshow', {path: '/', expires: expirationDays});
}

/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    // CommonJS
    factory(require('jquery'));
  } else {
    // Browser globals
    factory(jQuery);
  }
}(function ($) {

  var pluses = /\+/g;

  function encode(s) {
    return config.raw ? s : encodeURIComponent(s);
  }

  function decode(s) {
    return config.raw ? s : decodeURIComponent(s);
  }

  function stringifyCookieValue(value) {
    return encode(config.json ? JSON.stringify(value) : String(value));
  }

  function parseCookieValue(s) {
    if (s.indexOf('"') === 0) {
      // This is a quoted cookie as according to RFC2068, unescape...
      s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
    }

    try {
      // Replace server-side written pluses with spaces.
      // If we can't decode the cookie, ignore it, it's unusable.
      // If we can't parse the cookie, ignore it, it's unusable.
      s = decodeURIComponent(s.replace(pluses, ' '));
      return config.json ? JSON.parse(s) : s;
    } catch(e) {}
  }

  function read(s, converter) {
    var value = config.raw ? s : parseCookieValue(s);
    return $.isFunction(converter) ? converter(value) : value;
  }

  var config = $.cookie = function (key, value, options) {

    // Write

    if (value !== undefined && !$.isFunction(value)) {
      options = $.extend({}, config.defaults, options);

      if (typeof options.expires === 'number') {
        var days = options.expires, t = options.expires = new Date();
        t.setTime(+t + days * 864e+5);
      }

      return (document.cookie = [
        encode(key), '=', stringifyCookieValue(value),
        options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
        options.path    ? '; path=' + options.path : '',
        options.domain  ? '; domain=' + options.domain : '',
        options.secure  ? '; secure' : ''
      ].join(''));
    }

    // Read

    var result = key ? undefined : {};

    // To prevent the for loop in the first place assign an empty array
    // in case there are no cookies at all. Also prevents odd result when
    // calling $.cookie().
    var cookies = document.cookie ? document.cookie.split('; ') : [];

    for (var i = 0, l = cookies.length; i < l; i++) {
      var parts = cookies[i].split('=');
      var name = decode(parts.shift());
      var cookie = parts.join('=');

      if (key && key === name) {
        // If second argument (value) is a function it's a converter...
        result = read(cookie, value);
        break;
      }

      // Prevent storing a cookie that we couldn't decode.
      if (!key && (cookie = read(cookie)) !== undefined) {
        result[name] = cookie;
      }
    }

    return result;
  };

  config.defaults = {};

  $.removeCookie = function (key, options) {
    if ($.cookie(key) === undefined) {
      return false;
    }

    // Must not alter options, thus extending a fresh object...
    $.cookie(key, '', $.extend({}, options, { expires: -1 }));
    return !$.cookie(key);
  };

}));
/*
 *  End
 *  Jquery Cookie
 */


/** Set domain charityhowto.com in cookie */

jQuery(document).ready(function ($) {
  
  if (ga) {
      var gaCallback = function (){
          ga(function(tracker) {
              var utmData = {
                  'utmSource' : QueryString('utm_source'),
                  'utmMedium' : QueryString('utm_medium'),
                  'utmCampaign' : QueryString('utm_campaign'),
                  'utmTerm' : QueryString('utm_term'),
                  'utmContent' : QueryString('utm_content')
              };
              
              var referrer =  tracker.get('referrer');
              if(referrer && !utmData.utmSource)
                  utmData.utmSource = referrer.replace(/^https?\:\/\//i, "");
              else if (!referrer && !utmData.utmSource)
                  utmData.utmSource = 'Direct';
                  
              if ($.cookie('ga_contact_referrer') === undefined) {
                  //capture Lead source
                  console.log($.cookie('ga_contact_referrer', JSON.stringify(utmData), { expires: 1, path: '/', domain: 'charityhowto.com'}));
              }
          });
          return true;
      };
     
      
      ga('send', 'pageview', {'hitCallback': function() {
        gaCallback();
      }});
  }
});

function QueryString(variable) {
  return location.search.substring(1).split("&")
    .map(function (p) { return p.split("=") })
    .filter(function (p) { return p[0] == variable })
    .map(function (p) { return decodeURIComponent(p[1]) })
    .pop();
}