function spinner(string){
    $("#spinner").css("display", string);
}

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function soLetras(v){
    return v.replace(/\d/g,"") //Remove tudo o que não é Letra
}

function closeMenu(){
	$(".mobile-navigation").removeClass("-toggle"),
	$(".tcon-transform").removeClass("tcon-transform");
	if($(".tcon").is(".tcon-transform")){
			$(".mobile-navigation").fadeIn();
			setTimeout(function(){  
				$(".mobile-navigation").addClass('-toggle');
			}, 500);
	} else {
		$(".mobile-navigation").removeClass('-toggle');
		setTimeout(function(){  
			$(".mobile-navigation").fadeOut();
		}, 500);			
	}	
}

function _mobileNavigation(){
	$(".tcon").toggleClass("tcon-transform");
	if($(".tcon").is(".tcon-transform")){
			$(".mobile-navigation").fadeIn();
			setTimeout(function(){  
				$(".mobile-navigation").addClass('-toggle');
			}, 500);
	} else {
		$(".mobile-navigation").removeClass('-toggle');
		setTimeout(function(){  
			$(".mobile-navigation").fadeOut();
		}, 500);			
	}
} 

function accordion(selector){
	var $selector = $(selector);

	$selector.on("click", function (e) {
		$(this).toggleClass('toggle').next('.sub-menu').toggle();
	});	
}

function navAccordion(selector){
	var $this = $(selector),
		$children = $this.children();
		$children.each(function() {
			var $submenu = $(this).find('.sub-menu'),
				$has_menu = $submenu.length;

			if($has_menu)
				$submenu.children().each(function() {
					$(this).find('a').prepend('- ');
				});	
				$submenu.toggle();
				$submenu.prev('a')
					.attr('href','javascript:void(0)')
					.addClass('accordion')
					.append('<i class="fa fa-angle-down" />');
				accordion($submenu.prev('a'));			
		});		
}

navAccordion('.footer-navigation .menu,.mobile-navigation .menu');

$(window).on("resize scroll", function (e) {
	closeMenu();   
});

$(window).on("scroll", function (e) {
	var t = $(this).scrollTop();
	if (t >= 137){
	    $(".-sticky").addClass("-stuck");
	} else {
	    $(".-sticky").removeClass("-stuck");
	}
});

$(document).ready(function () {
	$('.owl-carousel:not(.galeria)').owlCarousel({
		items: 1,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		autoplay: true,
		autoplayTimeout: 7000,
		autoplayHoverPause: true,
		URLhashListener: true,
		loop: false,
		nav: false,
		dots: false
	});
	$('.galeria').owlCarousel({
		items: 4, 
		autoplay: true,
		autoplayTimeout: 7000,
		autoplayHoverPause: true,
		URLhashListener: true,
		loop: true,
		margin: 15,
		nav: true,
		dots: false,
        responsive : {
            0 : {
                items: 2
            },
            737 : {
                items: 3
            }
        },            
        navText: ["<i class='owl-prev-arrow fa fa-angle-left'></i>","<i class='owl-next-arrow fa fa-angle-right'></i>"]		
	});	 
	$( ".owl-thumbs" ).children().click(function() {
	$(this).toggleClass("-active");
	$(this).parent().find(".-active").not($(this)).removeClass();
	});
	$('.telefone').mask('(00) 0000-0000');
	$(".header").before($(".header").clone(true).addClass("-sticky"));
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
	});	
	$(".video").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
}); 
      
      