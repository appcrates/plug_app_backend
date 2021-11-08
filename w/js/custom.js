$(document).ready(function(){"use strict";var objowlcarousel=$(".owl-carousel-featured");if(objowlcarousel.length>0){objowlcarousel.owlCarousel({responsive:{0:{items:2,},600:{items:2,nav:false},1000:{items:5,},1200:{items:5,},},lazyLoad:true,pagination:false,loop:true,dots:false,autoPlay:false,navigation:true,stopOnHover:true,nav:true,navigationText:["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"]});}
var objowlcarousel=$(".owl-carousel-category");if(objowlcarousel.length>0){objowlcarousel.owlCarousel({responsive:{0:{items:3,},600:{items:5,nav:false},1000:{items:8,},1200:{items:8,},},items:8,lazyLoad:true,pagination:false,loop:true,dots:false,autoPlay:2000,navigation:true,stopOnHover:true,nav:true,navigationText:["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"]});}
$('[data-toggle="offcanvas"]').on('click',function(){$('body').toggleClass('toggled');});var mainslider=$(".owl-carousel-slider");if(mainslider.length>0){mainslider.owlCarousel({items:3,dots:false,lazyLoad:true,pagination:true,autoPlay:4000,loop:true,navigation:true,stopOnHover:true,nav:true,navigationText:["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"]});}
$('[data-toggle="tooltip"]').tooltip()
var sync1=$("#sync1");var sync2=$("#sync2");sync1.owlCarousel({singleItem:true,items:1,slideSpeed:1000,pagination:false,navigation:true,autoPlay:2500,dots:false,nav:true,navigationText:["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"],afterAction:syncPosition,responsiveRefreshRate:200,});sync2.owlCarousel({items:5,navigation:true,dots:false,pagination:false,nav:true,navigationText:["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"],responsiveRefreshRate:100,afterInit:function(el){el.find(".owl-item").eq(0).addClass("synced");}});function syncPosition(el){var current=this.currentItem;$("#sync2").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
if($("#sync2").data("owlCarousel")!==undefined){center(current)}}
$("#sync2").on("click",".owl-item",function(e){e.preventDefault();var number=$(this).data("owlItem");sync1.trigger("owl.goTo",number);});function center(number){var sync2visible=sync2.data("owlCarousel").owl.visibleItems;var num=number;var found=false;for(var i in sync2visible){if(num===sync2visible[i]){var found=true;}}
if(found===false){if(num>sync2visible[sync2visible.length-1]){sync2.trigger("owl.goTo",num-sync2visible.length+2)}else{if(num-1===-1){num=0;}
sync2.trigger("owl.goTo",num);}}else if(num===sync2visible[sync2visible.length-1]){sync2.trigger("owl.goTo",sync2visible[1])}else if(num===sync2visible[0]){sync2.trigger("owl.goTo",num-1)}}
});
$(document).ready(function () {
    var showChar = 100;
    var ellipsestext = "...";
    var moretext = "Show more <i class='fa fa-angle-double-right' aria-hidden='true'></i>";
    var lesstext = "Show less";
    $(".more p").each(function () {
        var content = $(this).html();
        if (content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + "</a></span>";
            $(this).html(html);
        }
    });
    $(".morelink").click(function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
(function($) {
function handlePreloader() {
        if($('.preloader').length){
            $('.preloader').delay(200).fadeOut(500);
        }
    }
    $(window).on('load', function() {
        handlePreloader();
    });
})(window.jQuery);
