<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<body id="top-of-page">
    <?php include(locate_template('parts/header.php')); ?>
    <div id="home">

        <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

        <section class="about bg-white">
            <div class="container">
                hdudhusds
            </div>
        </section>

    </div>

    <?php include(locate_template('parts/footer.php')); ?>
</body>

<?php get_footer(); ?>
