<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="options">

    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

    <div class="container">
        
        <div class="packages">
                
            <?php
            global $post;
            $args = array(
                'post_type'         => 'package',
                'posts_per_page'    => -1,
                'orderby'           => 'menu_order',
            );
            $posts = get_posts($args);

            if($posts): 
                $counter = 0;
                ?>
                <div class="row">
                <?php 
                foreach($posts as $post) : setup_postdata($post); 
                    $counter++;
                    ?>
                    <div class="col-md-4">
                        <div class="package">
                            <h4><?php the_title(); ?></h4>
                            <?php if(have_rows('options')): ?>
                            <ul class="options">
                                <?php while(have_rows('options')) : the_row(); ?>
                                    <li><?php the_sub_field('option_name'); ?></li>
                                <?php endwhile; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($counter % 3 == 0): ?>
                    </div>
                    <div class="row">
                    <?php endif; ?>
                    
                <?php 
                endforeach; 
                wp_reset_postdata();
                ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<div class="lightbox">
    <span class="lightbox-close"><i class="far fa-times"></i></span>
    
    <div class="lightbox-nav">
        <span class="lightbox-prev"><i class="far fa-angle-left"></i></span>
        <span class="lightbox-next"><i class="far fa-angle-right"></i></span>
    </div>
    
    <div class="lightbox-content">
        <img src="">
    </div>
</div>

<?php get_footer(); ?>
