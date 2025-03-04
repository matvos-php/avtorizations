// $(document).ready(function(){
//     $('.card__tarif').hover(function() {
//         $('.card__tarif').css('background-image','url('+$(this).find('img').attr('src') +')').css('filter', 'brightness(0.45)').fadeIn()
//       },
//       function () {
//         $('.card__tarif').css('color','#black').fadeOut();
//       }); 
// });


$('.button__tarif').on('click', function(){
    var value = $(this).val();
    console.log(value);
    $('#select_tarif option[value="' + value + '"]').attr('selected', 'true');
})

// '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
  }).resize();