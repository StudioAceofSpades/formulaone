<section id="hero" class="hero">
    <?php
    if(is_front_page()):
        include(locate_template('parts/hero/hero-home.php'));
    elseif(is_page_template('single-contact.php')):
        include(locate_template('parts/hero/hero-contact.php'));
    else:
        include(locate_template('parts/hero/hero-default.php'));
    endif;
    ?>
</section>
