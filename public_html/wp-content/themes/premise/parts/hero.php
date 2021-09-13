<section id="hero" class="hero">
    <?php
    if(is_front_page()):
        include(locate_template('parts/hero/hero-home.php'));
    elseif(is_page_template('single-contact.php')):
        include(locate_template('parts/hero/hero-contact.php'));
    elseif(is_tax()):
        include(locate_template('parts/hero/hero-default.php'));
    elseif(get_post_type() == 'trailer'):
        include(locate_template('parts/hero/hero-trailer.php'));
    else:
        include(locate_template('parts/hero/hero-default.php'));
    endif;
    ?>
</section>
