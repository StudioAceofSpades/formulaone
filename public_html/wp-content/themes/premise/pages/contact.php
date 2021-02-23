<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="contact">
    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>
</div>
<?php get_footer(); ?>
