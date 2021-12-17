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

        if($('#map').length) {
            initMap();
        }
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
            $('.lightbox-content img').attr('src', image);
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

    function generateMap(center) {

        var mapdiv  = document.getElementById("map");

        map = new google.maps.Map(mapdiv, {
            zoom        : 8,
            center      : center,
            zoomControl : false
        });

        geojson.features.forEach(function(feature) {
            markers.push(createDealer(feature));
        });

        distanceMatrixService = new google.maps.DistanceMatrixService();

        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("autocomplete"),
            { 
                types: ["geocode"],
                fields: ['place_id', 'geometry', 'formatted_address'] 
            }
        );
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

    function initMap() {

        var address = findGetParameter('zip');

        if(address) {
            geocoder = new google.maps.Geocoder();
            geocoder.geocode(
                { 'address' : address }, 
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        lat = results[0].geometry.location.lat();
                        lng = results[0].geometry.location.lng();

                        center = {'lat' : lat, 'lng': lng};
                        generateMap(center);
                    }
                }
            );
        } else {
            var center  = { lat: 41.693140, lng: -85.972748 };
            generateMap(center);
        }

        bindDealerForm();
        bindViewControls();
    }

    function bindViewControls() {
        var $map            = $('#map');
        var $desktopList    = $('.desktop-results');
        var $mobileList     = $('.mobile-results');

        $(window).on('resize', function() {
            if(window.innerWidth > 991) {
                $map.show();
                $desktopList.show();
                $mobileList.hide();
            } else {
                if($('.list-view').hasClass('active')) {
                    $map.hide();
                    $mobileList.show();
                } else {
                    $map.show();
                    $mobileList.hide();
                }
            }
        });

        $('.view-controls a').click(function(e) {
            e.preventDefault();
            if(! $(this).hasClass('active')) {
                $('.view-controls').find('.active').removeClass('active');
                $(this).addClass('active');
                $(window).trigger('resize');

                if($(this).hasClass('map-view')) {
                    $('.find-a-dealer form input[type="submit"]').trigger('click');
                }
            }
        });

        $(window).trigger('resize');
    }

    function updateMap(radius) {
        const place = autocomplete.getPlace();
        const marker = new google.maps.Marker({
            map: map
        });
        marker.setPosition(place.geometry.location);
        map.panTo(place.geometry.location);

        var center = {
            lat : place.geometry.location.lat(),
            lng : place.geometry.location.lng(),
        }
        if(bounds) {
            bounds.setMap(null);
        }
        bounds = new google.maps.Circle({
            strokeColor     : "#F05a28",
            strokeOpacity   : 0.8,
            strokeWeight    : 2,
            fillColor       : "#F05a28",
            fillOpacity     : 0.35,
            map,
            center          : center,
            radius          : radius.val() * 1609.34,
        });

        map.fitBounds(bounds.getBounds());

        for(var i = 0; i < markers.length; i++) {
            if(bounds.getBounds().contains(markers[i].getPosition())) {
                markers[i].setMap(map);
            } else {
                markers[i].setMap(null);
            }
        }
    }

    function bindDealerForm() {
        var $form = $('.find-a-dealer .map-controls form');
        if($form.length) {
            $form.find('input[type="submit"]').click(function(e) {
                e.preventDefault();

                var $radius         = $form.find('#radius');
                var $autocomplete   = $form.find('#autocomplete');

                if($radius.val() && $autocomplete.val()) {
                    updateMap($radius);
                    showResults();
                } else {
                    showErrors('fields');
                }
            });
        }
    }

    function showResults() {
        var $results    = $('.found-results');
        var $arena      = $results.find('.row');
        var $errors     = $('.error-message');
        var dealers     = [];

        $errors.hide();
        $arena.html('');
        $results.show();

        var skip = false;
        for(var i = 0; i < markers.length; i++) {
            if(markers[i].map !== null) {
                geojson.features.forEach(function(feature) {
                    if(feature.property.title == markers[i].getTitle()) {
                        dealers.push(feature);
                    }
                });
            }
        }
        
        if(dealers.length) {
            for(var i = 0; i < dealers.length; i++) {
                outputDealerResult(dealers[i], $arena);
            }
        } else {
            showErrors('no-results');
        }
    }

    function formatPhoneNumber(phoneNumberString) {
        var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
        var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
        if (match) {
            return '(' + match[1] + ') ' + match[2] + '-' + match[3];
        }
        return null;
    }

    function metersToMiles(i) {
        return i*0.000621371192;
    }

    function outputDealerResult(dealer, arena) {
        var phone           = formatPhoneNumber(dealer.property.phone);
        var tel             = dealer.property.phone;
        var address         = dealer.property.address;
        var website         = dealer.property.website;
        var title           = dealer.property.title;
        var center          = new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng());
        var dealerCenter    = new google.maps.LatLng(dealer.property.lat, dealer.property.lng);
        var distance        = google.maps.geometry.spherical.computeDistanceBetween(center, dealerCenter);
        distance            = metersToMiles(distance).toFixed(1);

        address = address.substring(1, address.length-1);

        var output = 
            '<div class="col-6 col-xs-12">' +
                '<div class="dealer-result">' +
                    '<h3>' + title + '</h3>' +
                    '<span class="distance">' + distance + ' miles</span>' +
                    '<div class="contact-info">' +
                        '<span class="address">' + address + '</span>' +
                        '<span class="phone"><a target="_blank" href="tel:' + tel + '">' + phone + '</a></span>' +
                        '<span class="website">' + website + '</span>' +
                    '</div>' +
                '</div>' +
            '</div>';
        arena.append(output);
    }

    function showErrors(error) {
        var $errors = $('.error-message');
        var $results = $('.found-results');

        $errors.hide();
        $results.hide();

        if(error == 'fields') {
            $('.fill-fields').show();
        } else if(error == 'no-results') {
            $('.no-results').show();
        }
    }

    function convertLatLong(coords) {
        var coordinates = {
            lat     : coords[1],
            lng    : coords[0],
        };
        return coordinates;
    }

    function createDealer(dealer) {
        var marker  = new google.maps.Marker({
            map         : map,
            position    : convertLatLong(dealer.geometry.coordinates),
            title       : dealer.property.title,
        });
        
        marker.addListener("click", function () {
            showDealer(dealer, marker);
        });
        return marker;
    }

    function showDealer(dealer, marker) {

        var address = dealer.property.address;
        address = address.substring(1, address.length-1);

        var contentString   =   
            '<div class="map-content">' +
            '<h1>' + dealer.property.title + '</h1>' + 
            '<span>Address: ' + address + '</span>' +
            '<span>Phone: ' + dealer.property.phone + '</span>' +
            '<span>Website: ' + dealer.property.website + '</span>' +
            '</div>';

        var info    = new google.maps.InfoWindow({
            content : contentString
        });
        info.open({
            anchor  : marker,
            map,
            shouldFocus : true,
        });
    }

    function addUserLocation() {
        const place = autocomplete.getPlace();

        const marker = new google.maps.Marker({
            map: map
        });

        marker.setLabel("You");
        marker.setPosition(place.geometry.location);

        map.panTo(place.geometry.location);
        map.setZoom(10);
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
                            scrollTop: target.offset().top
                        }, 1000, function() {
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                }
            });
    }

    function bindPopouts() {
        $(".popout-trigger").click(function(e) {
            e.preventDefault();
            //close all other popouts
            $(".popout").removeClass("active");

            var target = $(this).data("target");
            var popout = $("#" + target);

            popout.addClass("active");
        });

        $(".popout-close").click(function(e) {
            e.preventDefault();

            var popout = $(this).parents(".popout");
            popout.removeClass("active");
        });

        $('.popout').each(function() {
            if($(this).hasClass('mobile-only')) {
                $(this).addClass('started-mobile-only');
            }
        });
        $(window).resize(function() {
            if(window.innerWidth <= 767) {
                $('.popout').removeClass('mobile-only');
            } else {
                $('.popout').each(function() {
                    if($(this).hasClass('started-mobile-only')) {
                        $(this).addClass('mobile-only');
                    }
                });
            }
        });
        $(window).trigger('resize');

    }

    function createElements(elem) {
        if(typeof elem === "string") {
            var node = document.createTextNode(elem);
        } else {
            if(typeof elem.name !== "string" || typeof elem.attr !== "object") {
                console.error("Invalid node properties");
                return;
            }

            var node = document.createElement(elem.name);
            for(key in elem.attr) {
                let value = elem.attr[key];
                node.setAttribute(key, value);
            }

            if(typeof elem.children !== "undefined" && Array.isArray(elem.children)) {
                for(let i = 0; i < elem.children.length; i++) {
                    node.appendChild(createElements(elem.children[i]));
                }
            } else {
                console.warn("Children must be type array");
            }
        }
        return node;
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
