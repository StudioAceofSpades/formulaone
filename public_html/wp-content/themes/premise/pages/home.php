<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

    <div id="home">

        <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

        <section class="about bg-white">
            <div class="container">
                
            </div>
        </section>

    </div>   

<?php get_footer(); ?>
