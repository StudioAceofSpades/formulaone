<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<article id="post" class="post">

    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>


    <section class="page default">
        <?php 
        if(have_rows('content')) :
            $counter = 0;
            while(have_rows('content')) : 
                the_row(); 
                $counter++; 
                $layout = get_row_layout();
                ?>
                <div id="section-<?php echo $counter; ?>">
                    <?php include(locate_template('parts/page/'.$layout.'.php')); ?>
                </div>
                <?php
            endwhile;
        endif ?>
    </section>

</article>

<?php get_footer(); ?>
