/**
 * Created by Christoph Rohrmoser on 22.06.2017.
 */
// adding smooth scroll to the icon down on the start page
function scrollNav() {
    $('#iconDownContainer a').click(function(){
        //Toggle Class
        $(".active").removeClass("active");
        $(this).closest('li').addClass("active");
        var theClass = $(this).attr("class");
        $('.'+theClass).parent('li').addClass('active');
        //Animate
        $('html, body').stop().animate({
            scrollTop: $( $(this).attr('href') ).offset().top - 112
        }, 800);
        $('#linkKontakt').click();
        return false;
    });
    $('.scrollTop a').scrollTop();

}
scrollNav();