<?php $bg = get_field('background_image'); ?>

<div class="hero-wrapper hero-home" style="background-image: url(<?php echo ($bg['url'])?>)">
    <h1><?php the_field('tagline'); ?></h1>
    <?php include(locate_template('parts/hero/find-a-dealer.php')); ?>
</div>