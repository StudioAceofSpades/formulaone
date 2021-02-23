<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); }
get_header(); ?>

<div id="blog" class="blog category-feed">
    <?php include(get_stylesheet_directory() . "/parts/hero.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section class="feed">
                    <?php cfct_loop(); ?>
                </section>
                <?php cfct_misc('nav-posts'); ?>
            </div>
            <div class="col-md-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
