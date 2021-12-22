<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="options">

    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

    <div class="container">
        
        <?php if($trailers = get_field('configurations')): ?>
        <div class="packages">
            <?php
            global $post;
            foreach($trailers as $post): setup_postdata($post); ?>
            <div class="config">
                
                <h3><?php the_title(); ?></h3>

                <?php 
                if($packages = get_field('packages')): 
                    $counter = 0;
                    ?>
                    <div class="row">
                    <?php 
                    foreach($packages as $package): 
                        $pid = $package->ID; 
                        $counter++;
                        ?>
                        <div class="col-md-4">
                            <div class="package">
                                <h4><?php echo get_the_title($pid); ?></h4>
                                <?php if(have_rows('options', $pid)): ?>
                                <ul class="options">
                                    <?php while(have_rows('options', $pid)) : the_row(); ?>
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
                        
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>

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
