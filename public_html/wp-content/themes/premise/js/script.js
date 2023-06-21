var autocomplete;
var map;
var markers         = [];
var bounds;

(function($) {
    $(document).ready(function() {
        customSelect();
        heroDealerForm();
        headerNavigation();
        smoothScroll();
        bindPopouts();
        photoGalleryPopups();
        photoGalleryDesktop();
        photoGalleryMobile();
        singleTrailerSpecTable();
        configuratorTrailerSelect();
        optionsPage();
    });

    function optionsPage() {
        $('#option-filter').on('change', function() {
            var selected = $(this).find('option:selected').val();
            if(selected == 'all') {
                $('.option-group').show();
            } else {
                $('.option-group').hide();
                $('.option-group[data-name="' + selected + '"]').show();
            }
        });
        $('.option').click(function(e) {
            e.preventDefault();
            $('.lightbox').show();
            var image   = $(this).data('full');
            var index   = $(this).data('index');
            $('.lightbox-content img')
                .attr('src', image)
                .data('index', index);
        });
        $('.lightbox-next').click(function(e) {
            e.preventDefault();
            var $current    = $('.lightbox-content img');
            var current     = $current.data('index');
            var next        = current + 1;
            
            var $next = $('.option[data-index="' + next + '"]');

            if($next.length == 0) {
                $next = $('.option[data-index="1"]');
            }
            $('.lightbox-content img')
                .attr('src', $next.data('full'))
                .data('index', $next.data('index'));
        });
        $('.lightbox-prev').click(function(e) {
            e.preventDefault();
            var $current    = $('.lightbox-content img');
            var current     = $current.data('index');
            var next        = current - 1;
            
            var $next = $('.option[data-index="' + next + '"]');

            if($next.length == 0) {
                $next = $('.option').last();
            }
            $('.lightbox-content img')
                .attr('src', $next.data('full'))
                .data('index', $next.data('index'));
        });
        $('.lightbox-close').click(function(e) {
            e.preventDefault();
            $('.lightbox').hide();
        });
    }

    function configuratorTrailerSelect() {
        $('#switch-model').click(function(e) {
            e.preventDefault();

            $('.trailer-select'). addClass('open');
            $('body').addClass('no-scroll');
            $('.lifestyle-button').first().addClass('selected');
            $('.panel').first().show();
        });

        $('.close-trailer-select').click(function(e) {
            e.preventDefault();

            $('.trailer-select').removeClass('open');
            $('body').removeClass('no-scroll');
            $('.lifestyle-button').removeClass('selected');
            $('.panel').hide();
        });

        $('.lifestyle-button').click(function(e) {
            var panelToShow = $(this).data('panel');
            $('.lifestyle-button').removeClass('selected');
            $(this).addClass('selected');
            $('.panel').hide();
            $('.panel-'+panelToShow).show();
        });
    }

    function singleTrailerSpecTable() {
        var trailerSelect =$('#trailer-size');
        var selectedSize = trailerSelect.find(':selected').val();
        $('#' + selectedSize).show();

        trailerSelect.change(function() {
            var selectedSize = trailerSelect.find(':selected').val();
            $('.trailer-spec-table').hide();
            $('#' + selectedSize).show();
        })
    }

    function photoGalleryPopups() {
        $('.popup').slickLightbox();
    }

    function photoGalleryDesktop() {
        var slideCount = $('.photo-gallery-desktop').children().length;
        if (slideCount <= 1) {
            $('.slick-arrow-desktop').attr('style','display:none !important');
        }
        $('.photo-gallery-desktop').slick({
            adaptiveHeight: true,
            prevArrow: $('.slick-arrow-desktop.prev'),
            nextArrow: $('.slick-arrow-desktop.next'),
            dots: true
        });
        if (slideCount <= 1) {
            $('.photo-gallery-desktop .slick-slide').addClass('no-arrows');
        }
    }

    function photoGalleryMobile() {
        var slideCount = $('.photo-gallery-mobile').children().length;
        if (slideCount <= 1) {
            $('.slick-arrow-mobile').attr('style','display:none !important');
        }
        $('.photo-gallery-mobile').slick({
            adaptiveHeight: true,
            prevArrow: $('.slick-arrow-mobile.prev'),
            nextArrow: $('.slick-arrow-mobile.next'),
        });
        if (slideCount <= 1) {
            $('.photo-gallery-mobile .slick-slide').addClass('no-arrows');
        }
    }

	function findGetParameter(parameterName) {
		var result = null,
			tmp = [];
		location.search
			.substr(1)
			.split("&")
			.forEach(function (item) {
			  tmp = item.split("=");
			  if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
			});
		return result;
	}

    function headerNavigation() {
        $('.has-dropdown-desktop').hover(
            function(){
                $(this).addClass('active');
                $(this).children('.dropdown').stop().slideDown(300);
            },
            function(){
                $(this).removeClass('active');
                $(this).children('.dropdown').stop().slideUp(300);
            }
        );

        var $mobileTrigger          = $('.mobile-trigger'),
            $mobileMenu             = $('.mobile-navigation'),
            $mobileSubmenuTrigger   = $('.submenu-toggle');


        $mobileSubmenuTrigger.click(function(e) {
            e.preventDefault();

            $(this)
                .toggleClass('active')
                .siblings('.dropdown')
                .stop()
                .slideToggle();
        });

        $mobileTrigger.click(function(e) {
            e.preventDefault();

            $mobileMenu.stop().slideToggle();
        });

        $(window).on("resize",function(){
            if ( window.innerWidth >= 992 ) {
                $mobileMenu.stop().slideUp();
            }
        });
    }

    function smoothScroll() {

        var offset = 87;

        if($('.jumpnav').length) {
            offset = offset + $('.jumpnav').outerHeight() + 10;
        }

        $('a[href*="#"]')
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
                    && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - offset
                        }, 1000);
                    }
                }
            });
    }

    function customSelect() {
        var index = 1000;
        $('select').each(function(){

            var $this = $(this), numberOfOptions = $(this).children('option').length;
            $this.addClass('select-hidden'); 
            $this.wrap('<div class="select" style="z-index:' + index + ';"></div>');
            $this.after('<div class="select-styled" tabindex="0"></div>');

            index -= 1;

            var $styledSelect = $this.next('div.select-styled');
            $styledSelect.text($this.children('option').eq(0).text());

            var $list = $('<ul />', {
                'class': 'select-options'
            }).insertAfter($styledSelect);
            
            for (var i = 0; i < numberOfOptions; i++) {

                var option  = $this.children('option').eq(i);
                var text    = "<span>" + option.text() + "</span>";
                var rel     = option.val();
                var css     = option.attr('class');

                if(option.data('premium')) {
                    text += '<span class="premium-color-up"><i class="far fa-badge-dollar"></i>Premium Color</span>';
                }

                var $li = $('<li>', {
                    'class'     :   css,
                    'rel'       : rel,
                    'tabindex'  : 0,
                });

                $li.append(text);
                $li.appendTo($list);
            }

            var $listItems = $list.children('li');

            $styledSelect.click(function(e) {
                e.stopPropagation();
                $('div.select-styled.active').not(this).each(function(){
                    $(this).removeClass('active').siblings('ul.select-options').slideToggle(200).removeClass('open');
                });
                $(this).toggleClass('active').siblings('ul.select-options').slideToggle(200).toggleClass('open');
            });

            $listItems.click(function(e) {
                e.stopPropagation();
                $styledSelect.html($(this).html()).removeClass('active');
                $this.val($(this).attr('rel')).change();
                $list.slideUp(200).removeClass('open');
            });

            $(document).click(function() {
                $styledSelect.removeClass('active');
                $list.slideUp(200).removeClass('open');
            });
        });
    }

    function heroDealerForm() {

        var fad = "find-a-dealer";

        $('.'+fad+'-widget').each(function() {

            var form    = $(this).data('form');

            $("#submit-"+form).click(function(e) {
                e.preventDefault();

                var site    = $('.'+fad).data('site'),
                    zip     = $('#zip-'+form).val();
                    url     = site + '/'+fad+'?zip=' + zip;

                window.location.href = url;
            });
        })
    }

})( jQuery )
