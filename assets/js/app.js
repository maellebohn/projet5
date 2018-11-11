// main.js

var $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap-sass');

// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();

    $("#menu ul li a").click(function(){
        $("#menu ul li a").removeClass("active");
        $(this).addClass("active");
    });

    $("#news").click(function(){
        $("#tab2").show();
        $("#addnews_button").show();
        $("#tab1").hide();
        $("#tab3").hide();
        $("#addbird_button").hide();
        $("#addinfo_button").hide();
    });

    $("#infos").click(function(){
        $("#tab1").show();
        $("#addinfo_button").show();
        $("#tab2").hide();
        $("#tab3").hide();
        $("#addnews_button").hide();
        $("#addbird_button").hide();
    });

    $("#birds").click(function(){
        $("#tab3").show();
        $("#addbird_button").show();
        $("#tab2").hide();
        $("#tab1").hide();
        $("#addinfo_button").hide();
        $("#addnews_button").hide();
    });

    var affichage = Cookies.get('close-bloc');
    if (affichage == null) {
        var affichage = 'normal';
    }
    if (affichage === 'normal') {
        $(document).ready(function() {
            $("#cookie").show();
        });
    }
    if (affichage ==='hide') {
        $(document).ready(function() {
            $("#cookie").fadeOut("fast");
        });
    }
    $("#ok_cookie").click(function() {
        Cookies.set('close-bloc', 'hide', { expires: 7 });
        $("#cookie").fadeOut("fast");
    });

});
