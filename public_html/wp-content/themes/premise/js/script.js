var autocomplete;
var map;

(function($) {
	$(document).ready(function() {
        headerNavigation();
        smoothScroll();
        bindPopouts();
        initMap();
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

})( jQuery )
