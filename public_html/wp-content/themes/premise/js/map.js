var map;
var markers         = [];
var bounds;

(function($) {
    $(document).ready(function() {
        if($('#map').length) {
            initMap();
        }
    });

    function handleGeocoding(radius, zip = false, init = false) {
        
        var geocoder    = new google.maps.Geocoder();

        geocoder.geocode(
            {
                "address"   : 'zipcode ' + zip,
            }, 
            function(results, status) {
                var center = {
                    lat : false,
                    lng : false,
                };
                if (status == google.maps.GeocoderStatus.OK) {
                    center.lat = results[0].geometry.location.lat();
                    center.lng = results[0].geometry.location.lng();
                    updateMap(radius, center, init);
                }
            }
        );
    }

    function initMap() {
        var address = findGetParameter('zip');
        var radius  = $('#radius').val();
        if(address) {
            $('#autocomplete').val(address);
        } else {
            address = '46514';
        }

        handleGeocoding(radius, address, true);
        bindDealerForm();
        bindViewControls();
    }

    function updateMap(radius, center, init = false) {
        if(init) {
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
        }
        
        marker = new google.maps.Marker({
            map: map
        });
        
        marker.setPosition(center);
        map.panTo(center);

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
            radius          : radius * 1609.34,
        });

        map.fitBounds(bounds.getBounds());

        for(var i = 0; i < markers.length; i++) {
            if(bounds.getBounds().contains(markers[i].getPosition())) {
                markers[i].setMap(map);
            } else {
                markers[i].setMap(null);
            }
        }
        showResults();
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
            }
        });

        $(window).trigger('resize');
    }


    function bindDealerForm() {

        $('#autocomplete').keydown(function(e) {
            if(e.which == 13) {
                e.preventDefault();
                $('#submit').trigger('click');
            }
        });

        $('#submit').on('click', function(e) {
            e.preventDefault();
            
            if($('#autocomplete').val().length != 5) {
                alert('Please use a valid five-digit ZIP Code.');
            } else {
                handleGeocoding($('#radius').val(), $('#autocomplete').val());
            }
        });

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

})( jQuery )
