<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

    <div class="home">

        <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

        <section class="abo ut bg-white">
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
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <?php if($icon = get_sub_field('image')): ?>
                                <div class="image" style="background-image: url(<?php echo $icon['url']; ?>);">
                                    
                                    <?php if($title = get_sub_field('title')): ?>
                                    <h3><?php echo $title; ?></h3>
                                    <?php endif; ?>

                                    <?php if($link = get_sub_field('link')): ?>
                                    <a href="<?php echo $link['url']; ?>" class="panel-link"></a>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>

                            </div>
                            <?php endwhile; ?>
                        </div>
                                </div>
                <?php endif; ?>

                <div class="button">
                    <?php if($button = get_field('lifestyle_button')): ?>
                    <div class="button text-center">
                        <a href="<?php echo $button['url']; ?>" class="button orange"><?php echo $button['title']; ?></a>
                    </div>
                    <?php endif; ?>
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
