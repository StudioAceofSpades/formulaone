<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

global $post;

get_header(); ?>

<div id="package">

    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

    <?php if(have_rows('package_group')): ?>
    <div class="jumpnav">
        <div class="container">
            <h3>What can we help you find?</h3>
            <nav>
                <ul>
                <?php while(have_rows('package_group')) : the_row(); ?>
                    <li>
                        <?php if($title = get_sub_field('package_group_title')): ?>
                            <a href="#<?php echo slugify($title); ?>"><?php echo $title; ?></a>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(have_rows('package_group')): ?>
    <div class="container">
        <div class="packages">
            <?php while(have_rows('package_group')) : the_row(); $title = get_sub_field('package_group_title'); ?>
                <div class="package-group" id="<?php echo slugify($title); ?>">
                    <h2><?php echo $title; ?></h2>
                    <?php if($posts = get_sub_field('packages')): ?>

                        <div class="row">
                        <?php 
                        $counter = 0;
                        foreach($posts as $post) : setup_postdata($post); 
                            $counter++;
                            ?>
                            <div class="col-md-3">
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

                            <?php if($counter % 4 == 0): ?>
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
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

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
