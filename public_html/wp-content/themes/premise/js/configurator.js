(function($) {
    $(document).ready(function() {
        initConfigurator();
        initColorSelects();
        initImageControls();
        initPackages();
        initSummaryControls();
        initModalControls();
    });

    function initModalControls() {
        $('[data-trigger]').click(function(e) {
            e.preventDefault();
            
            var action = $(this).data('trigger');
            if(action == 'share' || action == 'quote') {
            
                $('.modal').show();
                var checkbox = $('.modal input[type="checkbox"]');

                if(action == 'share') {
                    $('.modal .simple').show();
                    $('.modal .advanced').hide();

                    if(checkbox.is(':checked')) {
                        checkbox.trigger('click');
                    }
                } else if(action == 'quote') {
                    $('.modal .simple').hide();
                    $('.modal .advanced').show();

                    if(!checkbox.is(':checked')) {
                        checkbox.trigger('click');
                    }
                }

                var $summary = $('.gfield_visibility_hidden textarea');
                $summary.val('');
                var html = '';
                $('.summary-item').each(function() {
                    var name    = $(this).find('h3').html();
                    var value   = $(this).find('p').html();
                    
                    html += name + ': ';
                    html += value + '\n';
                });
                $summary.val(html);
            }

        });
        $('.modal').click(function(e) {
            if(e.target !== this) {
                return;
            }
            $('.modal').hide();
        });
        $(document).keyup(function(e) {
            if(e.key === 'Escape') {
                $('.modal').hide();
            }
        });
    }

    function initColorSelects() {
        $('.color').on('change', function() {
            var $select         = $(this);
            var $styleSelect    = $select.siblings('.select-styled');
            var $selected       = $select.find(':selected');
            var $options        = $select.siblings('.select-options');
            var textColor       = $selected.data('text-color');
            var background      = $selected.data('background');

            $styleSelect
                .removeClass('dark')
                .removeClass('light')
                .addClass(textColor)
                .css('background-image', "url('" + background + "')");

            if(!$select.hasClass('init')) {
                $select.find('option').each(function() {
                    var $option     = $(this);
                    var key         = $option.val();
                    var textColor   = $option.data('text-color');
                    var background  = $option.data('background');
                    $options
                        .find('[rel="' + key  + '"]')
                        .removeClass('dark')
                        .removeClass('light')
                        .addClass(textColor)
                        .css('background-image', "url('" + background + "')"); 
                });
            }

            $select.addClass('init');

            updatePrice(getBasePrice(), getColorPrice(), getPackagePrice());
        });
        $('.color').trigger('change');
    }

    function initImageControls() {
        $('[data-update]').on('change', function() {
            var $select = $(this);
            var $target = $('.trailer-image .' + $select.data('update'));
            var image   = $select.find(':selected').data('image');
            if(image) {
                $target.html('<img src="' + image + '">');
            }
        });
        $('[data-update]').trigger('change');
    }

    function initConfigurator() {
   		var trailer = getParameterByName('model');
        if(!trailer) {
            $('#switch-model').trigger('click');
        }
        var lifestyle = getParameterByName('lifestyle');
        if(lifestyle) {
            $('[data-panel="' + lifestyle +  '"]').trigger('click');
        }
    }
    function initSummaryControls() {
        setBasePrice();
        
        $('[data-name]').on('change', function() {
            var name    = $(this).data('name');
            var value   = $(this).val();
            
            if($(this).find(':selected').data('premium') == 1) {
                var minPrice = roundPrice(parseInt($('.configurator').data('three')) * getMarkup());
                var maxPrice = roundPrice(parseInt($('.configurator').data('four')) * getMarkup());
                $('[data-summary="' + name + '"]')
                    .html(value + '<span class="price">$' + minPrice + ' - $' + maxPrice + '</span>')
                    .parents('.summary-item')
                    .addClass('has-price');
            } else {
                $('[data-summary="' + name + '"]')
                    .html(value)
                    .parents('.summary-item')
                    .removeClass('has-price');
            }
        });
        $('[data-name]').trigger('change');
        $('.close-summary').click(function(e) {
            e.preventDefault();
            $('.summary-container').removeClass('open');
        });
        $('[data-trigger="summary"]').click(function(e) {
            e.preventDefault();
            $('.summary-container').addClass('open');
        });
    }

    function updatePrice(base, color, package) {
        var colorMinPrice   = 0;
        var colorMaxPrice   = 0;
        if(color.length) {
            for(var n = 0; n < color.length; n++) {
                colorMinPrice += color[n][0];
                colorMaxPrice += color[n][1];
            }
        }

        if(typeof package == 'number') {
            if(colorMinPrice == 0) {
                var total       = base + package;
                $('[data-summary="msrp"]').html('$' + total);
            } else {
                var minTotal = base + colorMinPrice + package;
                var maxTotal = base + colorMaxPrice + package;
                $('[data-summary="msrp"]').html('$' + minTotal + ' - $' + maxTotal);
            }
        } else {
            var minTotal = base + colorMinPrice + package[0];
            var maxTotal = base + colorMaxPrice + package[1];
            $('[data-summary="msrp"]').html('$' + minTotal + ' - $' + maxTotal);
        }
    }

    function setBasePrice() {
        var $price      = $('[data-summary="name"] .price');
        var price       = roundPrice(getMarkup() * $price.data('pricing'));
        $price.html('$' + price);
    }

    function getBasePrice() {
        return roundPrice(getMarkup() * $('[data-summary="name"] .price').data('pricing'));
    }

    function getColorPrice() {
        var total   = [];
        var markup  = getMarkup();
        var min     = roundPrice(parseInt($('.configurator').data('three')) * markup);
        var max     = roundPrice(parseInt($('.configurator').data('four')) * markup);

        $('.color').each(function() {
            var $selected = $(this).find(':selected');
            if($selected.length && $selected.data('premium') == 1) {
                total.push([min,max]);
            }
        });
        return total;
    }

    function getSurcharge() {
        return (1 + (parseInt($('.configurator').data('one')) / 100));
    }

    function getMSRP() {
        return (1 + (parseInt($('.configurator').data('one')) / 100));
    }

    function getMarkup() {
        return getSurcharge() * getMSRP();
    }

    function roundPrice(number) {
        return Math.ceil(number / 10) * 10;
    }

    function getPackagePrice() {
        var $pricePackage   = $('.package.selected.has-price');
        var markup          = getMarkup();

        if($pricePackage.length) {

            if($pricePackage.hasClass('has-price-range')) {
                var min = parseInt($pricePackage.data('min-price')) * markup;
                var max = parseInt($pricePackage.data('max-price')) * markup;
                return [roundPrice(min), roundPrice(max)];
            } else {
                return roundPrice(parseInt($pricePackage.data('price')) * markup);
            }
        } else {
            return 0;
        }
    }

    function initPackages() {
        $('.package .control').click(function(e) {
            e.preventDefault();

            var basePrice       = $('[data-summary="name"] .price').data('pricing');
            var $price          = $('[data-summary="msrp"]');
            var $package        = $(this).parents('.package');

            if($package.hasClass('selected')) {
                $package.removeClass('selected');
                $('.package').removeClass('disabled');
                $('[data-summary="package"]').html('None');
            } else {
                if(!$package.hasClass('disabled')) {
                    $('.package').addClass('disabled');
                    $package.removeClass('disabled').addClass('selected');
                    var name = $package.find('h3').html();
                    
                    var price = getPackagePrice();
                    if(price) {
                        if(typeof price == 'number') { 
                            $('[data-summary="package"]')
                                .html(name + '<span class="price">$' + price + '</span>')
                                .parents('.summary-item')
                                .addClass("has-price");
                        } else {
                            minPrice    = price[0];
                            maxPrice    = price[1];

                            $('[data-summary="package"]')
                                .html(name + '<span class="price">$' + minPrice + ' - $' + maxPrice +'</span>')
                                .parents('.summary-item')
                                .addClass("has-price");
                        }
                    } else {
                        $('[data-summary="package"]')
                        .html(name)
                        .parents('.summary-item')
                        .removeClass('has-price');
                    }
                    
                    var newBase         = $package.find('.new-base');
                    var originalBase    = $('.trailer-image').data('original');
                    if(newBase.length) {
                        $('.base').attr('src', newBase.data('image'));
                    } else {
                        $('.trailer-image').attr('src', originalBase);
                    }
                }
            }
            
            if(getBasePrice()) {
                updatePrice(getBasePrice(), getColorPrice(), getPackagePrice());
            }

        });
    }
	function getParameterByName(name, url = window.location.href) {
		name = name.replace(/[\[\]]/g, '\\$&');
		var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, ' '));
	}
})( jQuery )
