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
        $(this).addClass("active")
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
   //
   // $("form").submit(function(event){
   //      var content = tinyMCE.activeEditor.getContent();
    // or     var content = tinyMCE.get("add_info_content").getContent();
    //     $("#add_info_content2").html(content);
   // });

});
