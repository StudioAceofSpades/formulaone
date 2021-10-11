<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
get_header(); ?>

<?php if(is_tax('lifestyle')): ?>
    <?php include(locate_template('posts/lifestyle.php')); ?>
<?php else: ?>
<div id="blog" class="blog">
    
    <?php include(get_stylesheet_directory() . "/parts/hero.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <section class="feed">
                    <?php cfct_loop(); ?>
                </section>
                <section class="pages">
                    <?php echo paginate_links(); ?>
                </section>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
