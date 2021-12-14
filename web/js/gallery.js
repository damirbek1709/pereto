// Basic initialization is like this:
// $('.your-class').slick();

// I added some other properties to customize my slider
// Play around with the numbers and stuff to see
// how it works.
$('.slick-carousel').slick({
    infinite: true,
    slidesToShow: 1, // Shows a three slides at a time
    slidesToScroll: 1, // When you click an arrow, it scrolls 1 slide at a time
    arrows: true, // Adds arrows to sides of slider
    dots: true, // Adds the dots on the bottom
    fade: true,
    prevArrow: '<i class="slick-prev fas fa-chevron-left"></i>',
    nextArrow: '<i class="slick-next fas fa-chevron-right"></i>',
});