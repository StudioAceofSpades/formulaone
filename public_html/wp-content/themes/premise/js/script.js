var autocomplete;
var map;

(function($) {
	$(document).ready(function() {
        headerNavigation();
        smoothScroll();
        bindPopouts();
        initMap();
        customSelect();
    });

    function initMap() {
        var mapdiv = document.getElementById("map");
var image = "http://maps.google.com/mapfiles/ms/micons/blue.png";
        map = new google.maps.Map(mapdiv, {
            zoom: 12,
            center: { lat: 41.693140, lng: -85.972748 },
            zoomControl: false
        });

        map.data.addGeoJson(geojson, {idPropertyName:'storeid'});

        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("autocomplete"),
            { 
                types: ["geocode"],
                fields: ['place_id', 'geometry', 'formatted_address'] 
            }
        );
        autocomplete.addListener("place_changed", addUserLocation);
    }

	function addUserLocation() {
		const place = autocomplete.getPlace();

		const marker = new google.maps.Marker({
			map: map
		});

		marker.setLabel("C");
		marker.setPosition(place.geometry.location);

		map.panTo(place.geometry.location);
		map.setZoom(12);
	}

    function headerNavigation() {
		var $target = $('.dropdown');
		
		$target.hover(function() {
			$(this).find('.dropdown-wrapper').show();
		}, function() {
			$(this).find('.dropdown-wrapper').hide();
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
        $('select').each(function(){
            var $this = $(this), numberOfOptions = $(this).children('option').length;
            $this.addClass('select-hidden'); 
            $this.wrap('<div class="select"></div>');
            $this.after('<div class="select-styled" tabindex="0"></div>');

            var $styledSelect = $this.next('div.select-styled');
            $styledSelect.text($this.children('option').eq(0).text());

            var $list = $('<ul />', {
                'class': 'select-options'
            }).insertAfter($styledSelect);

            for (var i = 0; i < numberOfOptions; i++) {
                $('<li />', {
                    text: $this.children('option').eq(i).text(),
                    rel: $this.children('option').eq(i).val(),
                    class: $this.children('option').eq(i).attr("class"),
                    tabindex: "0"
                }).appendTo($list);
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
                $styledSelect.text($(this).text()).removeClass('active');
                $this.val($(this).attr('rel')).change();
                $list.slideUp(200).removeClass('open');
            });

            $(document).click(function() {
                $styledSelect.removeClass('active');
                $list.slideUp(200).removeClass('open');
            });
        });
    }


})( jQuery )
