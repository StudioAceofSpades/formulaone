<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

    <div class="home">

        <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

        <section class="about bg-white">
            <div class="container">

                <?php if($header = get_field('lifestyle_header')): ?>
                    <div class="row">
                        <div class="col text-center">
                            <p class="title"><?php echo $header; ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(have_rows('lifestyles')): ?>
                    <div class="lifestyle">
                        <div class="row">
                            <?php while(have_rows('lifestyles')) : the_row(); ?>
                                <div class="col-lg-3 col-md-6">
                                    <a href="<?php the_sub_field('link') ?>" style="background-image: url(<?php the_sub_field('image'); ?>);">
                                        <span><?php the_sub_field('title'); ?></span>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($button = get_field('lifestyle_button')): ?>
                    <div class="buttons">
                        <a href="<?php echo $button['url']; ?>" class="button orange"><?php echo $button['title']; ?></a>
                    </div>
                <?php endif; ?>

                <div class="build">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="<?php bloginfo('template_directory'); ?>/img/config-section-trailer.png" class="img-fluid">
                        </div>
                        <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <?php if(get_field('build_header')): ?>
                                <p class="title"><?php the_field('build_header'); ?></p>
                            <?php endif; ?>
                            <?php if(get_field('build_subheader')): ?>
                                <p><?php the_field('build_subheader'); ?></p>
                            <?php endif; ?>
                            <div class="buttons">
                                <a href="<?php bloginfo('url'); ?>/build-yours" class="button orange">Build your Trailer</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonials">
                    <div class="row">
                        <?php 
                        $header = get_field('testimonial_header');
                        $subheader = get_field('testimonial_subheader');
                        $n = 0;
                        ?>
                        <?php if($header|| $subheader): ?>
                            <?php $n++; ?>
                            <div class="col-md-6 d-flex flex-column align-self-center">
                                <p class="header"><?php echo $header; ?></p>
                                <p class="subheader"><?php echo $subheader; ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if(have_rows('testimonials')): ?>
                            <?php while(have_rows('testimonials')) : the_row(); ?>
                                <div class="col-md-6 d-flex">
                                    <div class="testimonial d-flex w100">
                                        <div class="d-flex align-self-center flex-column w100">
                                            <?php if($quote = get_sub_field('quote')): ?>
                                                <h3 class="quote"><?php echo $quote; ?></h3>
                                            <?php endif; ?>
                                            <?php if($person = get_sub_field('person')): ?>
                                                <h3 class="person"><?php echo $person; ?></h3>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $n++; ?>
                                <?php if($n % 2 == 0):?>
                                    </div>
                                    <div class="row">
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php get_footer(); ?>
