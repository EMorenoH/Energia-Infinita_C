$('.container-menu.covid').hide();

//$('.container-menu-covid').css({
//    left: '-100%'
//});


$('.icon-menu-covid').on('click', function(){
    
    $('.container-menu-covid').show();
    $('.container-menu-covid').animate({
        left: '0%'
    }, 'swing');
    
    $('main-covid').addClass("main2-covid");
    
})


$('.close-covid').on('click', function(){
    
    $('.container-menu-covid').animate({
        left: '-100%'
    }, 'swing');
    $('main-covid').removeClass("main2-covid");
    
})

