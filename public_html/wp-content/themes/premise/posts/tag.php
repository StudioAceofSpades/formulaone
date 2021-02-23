<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); }
get_header();
?>

<div id="blog" class="blog tag-feed">
    <?php include(get_stylesheet_directory() . "/parts/hero.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <?php cfct_loop(); ?>
                <?php cfct_misc('nav-posts'); ?>
            </div>
            <div class="col-sm-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
