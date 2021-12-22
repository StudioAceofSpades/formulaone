<?php $bg = get_field('background_image'); ?>

<div class="hero-wrapper hero-contact" style="background-image: url(<?php echo ($bg['url'])?>)">
    <div class="container-fluid">
        <div class="row">
            <?php if(get_field('page_subtitle')): ?>
                <div class="col-md-3 d-flex align-items-end">
                    <h1><?php the_field('page_title'); ?></h1>
                </div>
                <div class="col-md-9 d-flex align-items-end">
                    <h2><?php the_field('page_subtitle'); ?></h2>
                </div>
            <?php else: ?>
                <div class="col">
                    <?php the_field('page_title'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block">
                <?php include(locate_template('parts/contact-info.php')); ?>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-6">
                <?php
                $classes = "flex-column flex-md-row";
                include(locate_template('parts/hero/find-a-dealer.php'));
                ?>
            </div>
        </div>
    </div>
</div>
