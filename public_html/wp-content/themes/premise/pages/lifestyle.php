<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div class="all-lifestyle">

    <section class="about bg-white">
        <div class="container">

            <?php if($header = get_field('lifestyle_header')): ?>
            <div class="row">
                <div class="col text-center">
                    <h1><?php echo $header; ?></h1>
                </div>
            </div>
            <?php endif; ?>

            <?php if(have_rows('lifestyles')): ?>
                <div class="lifestyle">
                    <div class="row">
                        <?php while(have_rows('lifestyles')) : the_row(); ?>
                            <div class="col-md-6">
                                <a href="<?php the_sub_field('link') ?>" style="background-image: url(<?php the_sub_field('image'); ?>);">
                                    <span><?php the_sub_field('title'); ?></span>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        <div>
    <section>
</div>
<?php get_footer(); ?>
