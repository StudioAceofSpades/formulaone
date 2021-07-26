<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="contact">
    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php cfct_loop(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
