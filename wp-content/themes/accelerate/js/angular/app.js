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
            $('#emailModalForm').modal('show');
            $("#emailModalForm").attr("displayed", "true");
        }
    });

    jQuery("#dismiss-email-modal").on("click", function() {
        notShowModalAgain();
    })
});

function submitEmail(token) {
    jQuery.ajax('http://localhost:8080/public/subscribe-from-blog', {
        type: 'POST',
        data: {
            token: token,
            email: jQuery("#subscriber-email").val()
        },
        success: function () {
            notShowModalAgain();
            jQuery("#emailModalForm").modal('toggle');
        }
    });
}

function notShowModalAgain() {
    document.cookie = "showpoupemail=notshow; path=/";
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
    else return null;
}

