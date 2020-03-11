$(document).ready(function(){
  $(".owl-carousel").owlCarousel();
});





function tamanho(){
    altural1 = $('.contem-sub.link1 .over-bottom').height();
    meioPagination = (675-larguraPagination) / 2;
    $("ul.pagination").css('margin-left', meioPagination+'px');
};
$(document).ready(function() {
    tamanho();
});

$(function() {

    $(".free").hover(function(){
        $(this).addClass('new');
        $(this).find(".over").stop().animate({opacity: '1', left:'0px'},220, function(){
            setTimeout(function() {
                $(".menu-lateral li.new").addClass('hover');
            });});
    },function(){
        $(this).removeClass('new');
        $(this).removeClass('hover');
        $(this).find(".over").stop().animate({opacity: '0', left:'-100%'},220);
    });


});
