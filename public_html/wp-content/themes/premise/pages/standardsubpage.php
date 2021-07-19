<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="standardsubpage">
    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

    <div class="container">
        <div class="form d-flex justify-content-center">
        <?php cfct_loop(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
