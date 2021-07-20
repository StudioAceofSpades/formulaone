<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); }
get_header(); ?>

<?php if(is_tax('lifestyle')): ?>
    <?php include(locate_template('posts/lifestyle.php')); ?>
<?php else: ?>
<div id="blog" class="blog">
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
<?php endif; ?>

<?php get_footer(); ?>
