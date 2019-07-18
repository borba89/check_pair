$(document).ready(function () {
	// preLoader();
    parallaxBackground();
	sliders();
	scrollTop();
	hoverTopMenu();
	toogleFilter();
    toggleMobile();
	mobileTouch();
	dropLang();
	widthResize();
	listCounter();
	initContentFancybox();
    addToFavotites();
    mobileLangSwitch();
    $('select').material_select();
	var selectedOptions=[
		"create",
		"update"
	];

	$.each(selectedOptions, function(i,e){
		$("#access_rights option[value='" + e + "']").prop("selected", true);
	});
	// $('.scrollspy').scrollSpy();

	//$('.form-control').select2();

	if(window.innerWidth <= "991") {
		$('.button-collapse').sideNav({
			menuWidth: 300,
			edge: 'left',
			closeOnClick: true,
			draggable: true
		});
		$('.collapsible').collapsible();
	}


	// $('.wish-sign').click(function(evt) {
	// 	evt.preventDefault();
	// 	evt.stopPropagation();
	// 	location.reload();
	// });

	$(function() {
		jQuery.scrollSpeed(100, 1000);
		jQuery.scrollSpeed(100, 1000, 'easeOutCubic');
	});


	$(".side-nav li a").click(function(e) {
		console.log('side link clicked');
		e.preventDefault();
		var destination = $(this).attr('href');
		setTimeout(function() { window.location.href = destination; }, 500);
	});
	var $mobileFilterBlock = $('.mobile-filter-block');
	$('.mobile-filter-block button.submit').click(function () {
		var $projectSection = $('#content-outer');
		var $destination = ($projectSection.offset().top)-90;
		$('html,body').animate( { scrollTop: $destination }, 1000 );
	});
	$('.mobile-filter-block a.execute').click(function (event) {
		$(this).closest($mobileFilterBlock).slideUp('slow');
		$('.toggle-mobile').removeClass('opened');
		$('body').removeClass('no-scroll');
		event.preventDefault();
	});
    $('.reload').click(function(e) {
        e.preventDefault();
        var url = $( ".reload" ).prop('href');
        window.location.href = url;
    });

    $('.mobile-filter-block a.reset').click(function (event) {
        console.log('reset');
        $(this).closest('form').find('a.added').removeClass('added');
        $(this).closest($mobileFilterBlock).slideUp('slow');
        $('.toggle-mobile').removeClass('opened');
        $('body').removeClass('no-scroll');
        event.preventDefault();
    });

	var $filterList = $('.filter-list, .mobile-filter-block');
	$filterList.on('click', 'a', function(e) {
        e.stopPropagation();
        e.preventDefault();
		var self = $(this);
		var closest = self.closest('ul.uncheckAll');
		var filterList = self.parents('.filter-list').length;

        uncheckOption(self, closest, filterList);
        self.toggleClass('added');

		if (!self.hasClass("default")) {
            closest.find('a.default').removeClass('added').each(function() {
                if (closest.find('a.added').length == 0) {
                    closest.find('a.default').toggleClass('added');
                }
                updateValue($(this));
            });
		} else {
            closest.find('a:not(.default)').removeClass('added').each(function() {
                if (closest.find('a.added').length == 0) {
                    closest.find('a:not(.default)').toggleClass('added');
                }
                updateValue($(this));
            });
		}

        var form_id = $(this).closest("form").attr('id');
        updateValue(self);
        $.fn.yiiListView.update('realty-list', {
            type: 'post',
            data: $('#' + form_id).serialize(),
            complete:function(data) {
                var selectedFilter = $(data.responseText).find('.filter-bar').html();
                $('.filter-bar').html(selectedFilter);

                if (filterList) {
                    filterListProcessor(data);
				}

            }
        });
        return false;
	});

    $('a[href^="#"]').on('click',function (e) {

        if(!$(this).hasClass('js-prevent-scroll')){
            e.preventDefault();
            // $(this).closest('.nav').find('li').not(this).parent().removeClass('active');
            // $(this).parent('li').addClass('active');
            var current = $(this).parent();
            current.addClass('active')
                .siblings()
                .removeClass('active');

            var target = this.hash,
                $target = $(target);
            if($target.length){
                var offset = $target.offset().top
            }else {
                var offset = 0;
            }
            offsetMargin = ($(window).width() > 1400);
            $('html, body').stop().animate({
                'scrollTop': offset - offsetMargin
            }, 900, 'swing', function () {
                window.location.hash = target;
            });
        }
    });
});

function uncheckOption (self, closest, filterList) {
    if (self.data('value') == 'rent') {
        closest.find('a[data-value="sale"]').removeClass('added').each(function() {
            updateValue($(this));
        });
    } else {
        closest.find('a[data-value="rent"]').removeClass('added').each(function() {
            updateValue($(this));
        });
	}

    if (self.data('value') == 'estate' || self.data('value') == 'apartments') {
        self.closest('ul.uncheckAll').find('li a').filter(function() {
            if ($(this).data('value') != "estate" && $(this).data('value') != "apartments") {
            	return true;
			};
            return false;
        }).removeClass('added').each(function() {
            updateValue($(this));
        });
    } else {
        self.closest('ul.uncheckAll').find('li a').filter(function() {
            if ($(this).data('value') == "estate" || $(this).data('value') == "apartments") {
                return true;
            };
            return false;
        }).removeClass('added').each(function() {
            updateValue($(this));
        });
    }
}

function parallaxBackground() {
    var $parallaxSection = $('.parallax-window');
    if ($parallaxSection.length) {
        $parallaxSection.each(function () {
            $(window).on('load', function () {
                $parallaxSection.removeClass('load-background');
            });
        });
    }
}

function filterListProcessor(data) {
    var moneyFilter = $(data.responseText).find('#moneyFilter').html();
    var areaFilter = $(data.responseText).find('#areaFilter').html();

    $('#moneyFilter').html(moneyFilter);
    $('#areaFilter').html(areaFilter);
}

function addToFavotites() {
    $(document).on('click', '.add-to-favorite', function (e) {
        e.preventDefault();
        var button = $(this);
        var data = {'Product[id]': button.data('product-id')};
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: '/offer/front/add',
            success: function (data) {
                if (data.result) {
                    button.toggleClass('button-red button-grey');
                    $('#totalFav').html(data.data);
                }
            }
        });
    });
}

function mobileLangSwitch() {
    $(document).on('change', '#lang-1', function (e) {
        e.preventDefault();
        var url = $( "#lang-1 option:selected" ).data('url');
        window.location.href = url;
    });
}

function updateValue(e) {
    var fieldId = e.data('field');
    if (!e.is('.added'))
        var value = '';
    else
        var value = e.data('value');

    $('#' + fieldId).val(value);
}

function widthResize() {
	var width = $(window).width();
	$(window).on('resize', function(){
		if($(this).width() !== width){
			width = $(this).width();
			console.log('width resize');
			location.reload();
		}
	});
}
function listCounter(){
	var $numberList = $(".article-list > li");
	var number = 0;
	$numberList.each(function(n) {
		if(number < $numberList.length){
			number ++;
			$(this).find('span').before('<span class="li-span">' + number + '</span>')
		}

	});
}
function initContentFancybox() {
	var $container = $('.fancy-gallery');
	if($container.length){
		var $links = $container.find('a.inner.fancybox');
		$links.each(function(){
			$(this).prop('rel', 'group');
		});
		$links.fancybox({
			openEffect	: 'fade',
			closeEffect	: 'none',
			//maxWidth	: 1200,
			//maxHeight	: 850,
			aspectRatio : true,
			scrolling   : 'no',
			'speedIn'		:	100,
			'speedOut'		:	300,
			'overlayShow'	:	false,
			'loop': true
		});
		if ($(window).width() < 768) {
			var $linksMobile = $container.find('a.fancybox-mobile');
			$linksMobile.each(function(){
				$(this).prop('rel', 'group');
			});
			$linksMobile.fancybox({
				openEffect	: 'fade',
				closeEffect	: 'none',
				//maxWidth	: 1200,
				//maxHeight	: 850,
				aspectRatio : true,
				scrolling   : 'no',
				'speedIn'		:	100,
				'speedOut'		:	300,
				'overlayShow'	:	false,
				'loop': true,
                helpers: {
                    title: {type: 'over'}
                }, // helpers
                beforeShow: function () {
                    this.title = (this.title ? '' + this.title + '' : '') + '' + (this.index + 1) + ' / ' + this.group.length;
                }, // beforeShow
                afterShow: function () {
                    jQuery('.fancybox-wrap').swipe({
                        swipe: function (event, direction) {
                            if (direction === 'left' || direction === 'up') {
                                jQuery.fancybox.next(direction);
                            } else {
                                jQuery.fancybox.prev(direction);
                            }
                        }
                    });
                }
            });
		}
	}
	// $("a.fancybox").fancybox({
	// 	'transitionIn'	:	'elastic',
	// 	'transitionOut'	:	'elastic',
	// 	'speedIn'		:	600,
	// 	'speedOut'		:	200,
	// 	'overlayShow'	:	false
	// });
}

function mobileTouch() {
	var $hoverRed = $('.hover-red , .button-collapse, .fa-mobile , .fa-reply, .fa-sliders');
	$hoverRed.on('mousedown touchstart', function (e) {
		if (e.type === 'touchstart') {
			$(this).addClass('pressed');
		}
	});
	$hoverRed.on('mouseup touchend', function (e) {
		if (e.type === 'touchend') {
			$(this).removeClass('pressed');
		}
	});
	$hoverRed.on('mouseup touchmove', function (e) {
		if (e.type === 'touchmove') {
			$(this).removeClass('pressed');
		}
	});
	var $owlNav = $('.owl-prev , .owl-next');
	$owlNav.on('mousedown touchstart', function (e) {
		if (e.type === 'touchstart') {
			$(this).addClass('pressed');
		}
	});
	$owlNav.on('mouseup touchend', function (e) {
		if (e.type === 'touchend') {
			$(this).removeClass('pressed');
		}
	});
	$owlNav.on('mouseup touchmove', function (e) {
		if (e.type === 'touchmove') {
			$(this).removeClass('pressed');
		}
	});
}

function dropLang() {
	var $dropButton = $('.dropdown-button');
	var $dropContent = $('.dropdown-content');
	$dropButton.dropdown({
			inDuration: 300,
			outDuration: 225,
			constrainWidth: false,
			hover: true,
			gutter: 0,
			belowOrigin: false,
			alignment: 'left',
			stopPropagation: false
		}
	);
	$dropButton.on('click' , function(e){
		e.preventDefault();
	});
	$dropButton.add($dropContent).hover(
		function () {
			$('.anchor').addClass("result_hover");
		},
		function () {
			$('.anchor').removeClass("result_hover");
		}
	);
}

function sliders() {
	$('#home-slider').owlCarousel({
		loop: false,
		nav: true,
		dots: true,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		items: 1,
		navText: ['', '']
	});
    $('#service-slider').owlCarousel({
        loop: false,
        nav: true,
        dots: false,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
        items: 1,
        navText: ['', '']
    });
}

// $(window).on('load', function () {
// 	var $preloader = $('#p_prldr'),
// 		$svg_anm   = $preloader.find('.svg_anm');
// 	$svg_anm.fadeOut();
// 	$preloader.delay().fadeOut('slow');
// });

function hoverTopMenu() {
	if(window.innerWidth > "991") {
		var $container = $('header');
		$(".hover-menu , #main-menu").on({
			mouseenter: function () {
				$(this).closest($container).addClass('menu-hovered');
			},
			mouseleave: function () {
				$(this).closest($container).removeClass('menu-hovered');
			}
		});
	}
}

function scrollTop() {
	$(".anchor").on('click', function(event) {
		if (this.hash !== "") {
			event.preventDefault();
			var hash = this.hash;
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 1100, function(){
				window.location.hash = hash;
			});
		}
	});

	$(window).on('scroll', function() {
		if(parseInt($(window).scrollTop(), 10) > 400){
			$('#toTop').fadeIn(1000);
		}
		else {
			$('#toTop').fadeOut(1000);
		}
	});
}

function preLoader() {
	$(window).on('load', function () {
		var $preloader = $('#p_prldr');
		$preloader.delay(500).fadeOut('slow');
	});
}

function initMap() {
	var myLatLng = {lat: 47.045188, lng: 28.768946};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 18,
		center: myLatLng
	});

	image = {
		url: 'http://toffi-design.com/demo/img/Map-Marker.png',
		size: new google.maps.Size(36, 36),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(15, 30)
	};
	var infowindow = new google.maps.InfoWindow({
		content: '<strong>New Door Realty</strong><br>L. Deleanu str. 7/2,<br>Chișinău 2071<br> Moldova'
	});
	var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		icon: image,
		title: 'Мы здесь!'
	});
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	});
}
function toogleFilter() {
	var $contentSection = $('#content-outer');
    $('.filter-bar').click(function() {
    	$(this).closest('.main').find($contentSection).toggleClass('filter-outer');
        $('.toggle').toggleClass("on");
        $(".filter-list").slideToggle();
        $(".filter-bar").toggleClass('open');
    });
	$contentSection.click(function() {
		if ( $( this ).hasClass('filter-outer') ) {
			$(this).removeClass('filter-outer');
			$('.toggle').removeClass('on');
			$(".filter-list").slideUp('slow');
			$(".filter-bar").removeClass('open');
			var destination = ($contentSection.offset().top)-70;
			$('html,body').animate( { scrollTop: destination }, 1000 );
		}
	});
}
function toggleMobile() {
    var $container = $('.mobile-filter-block');
    var $formButton = $('.mobile-filter-block button');
    $('.toggle-mobile, .hide-filter').click(function(e) {
    	$container.slideToggle('slow');
    	$(this).toggleClass('opened');
    	$('body').toggleClass('no-scroll');
		e.preventDefault();
    });
	$formButton.click(function(e) {
		$container.slideToggle('slow');
		$('body').removeClass('no-scroll');
	});

}
