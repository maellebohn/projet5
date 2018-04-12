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
});

$(document).ready( function(){
    $("#menu ul li a").click(function(){
        $("#menu ul li a").removeClass("active");
        $(this).addClass("active")
    });
});
