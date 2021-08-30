(function($) {
    $(document).ready(function() {
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

    function initSummaryControls() {
        $('[data-name]').on('change', function() {
            var name    = $(this).data('name');
            var value   = $(this).val();

            $('[data-summary="' + name + '"]').html(value);
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

    function initPackages() {
        $('.package .control').click(function(e) {
            e.preventDefault();
            if($(this).parents('.package').hasClass('selected')) {
                $(this).parents('.package').removeClass('selected');
                $('.package').removeClass('disabled');
                $('[data-summary="package"]').html('None');
            } else {
                if(!$(this).parents('.package').hasClass('disabled')) {
                    $('.package').addClass('disabled');
                    $(this).parents('.package').removeClass('disabled').addClass('selected');
                    var $package = $('.package.selected');
                    var name = $('.package').find('h3').html();
                    $('[data-summary="package"]').html(name);
                }
            }
        });
    }
})( jQuery )
