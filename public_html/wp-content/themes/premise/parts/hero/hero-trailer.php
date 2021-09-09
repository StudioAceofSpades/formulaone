<?php $bg = get_field('background_image'); ?>

<div class="hero-wrapper hero-trailer" style="background-image: url(<?php echo ($bg['url'])?>)">
    <div class="title-wrapper">
        <?php
        if (get_field('page_title')):
            echo ('<h1>'.get_field('page_title').'</h1>');
        endif;
        if (get_field('page_subtitle')):
            echo('<h2>'.get_field('page_subtitle').'</h2>');
        endif;
        ?>
    </div>
    <?php include(locate_template('parts/hero/find-a-dealer.php')); ?>
</div>