// Basic initialization is like this:
//$('.slick-carousel').slick();

// I added some other properties to customize my slider
// Play around with the numbers and stuff to see
// how it works.
$('.slick-carousel').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: true, // Adds arrows to sides of slider
    dots: false, // Adds the dots on the bottom
    fade: true,
    prevArrow: '<i class="slick-prev fas fa-chevron-left"></i>',
    nextArrow: '<i class="slick-next fas fa-chevron-right"></i>',
});