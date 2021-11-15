<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$trailer_slug   = $_GET['model'];
$trailer        = false;

if($trailer_slug) {
    $args           = array(
        'name'              => $trailer_slug,
        'post_type'         => 'configurations',
        'posts_per_page'    => 1,
    );
    $posts      = get_posts($args);
    $trailer    = array_pop($posts);
    $id         = $trailer->ID;
    $image      = get_field('base_image', $id);
    $title      = get_the_title($id);
    $size       = get_field('trailer_size', $id);
    $specs      = get_field('sizing_specs', $id);
    $front      = get_field('front_color', $id);
    $back       = get_field('rear_color', $id);
    $stripe     = get_field('diagonal_split', $id);
    $packages   = get_field('packages', $id);
    $tprice     = get_field('price', $id);

    $second_image = $image;
}

get_header(); ?>

<section 
    data-one="<?php the_field('surcharge', 'options'); ?>"
    data-two="<?php the_field('msrp_markup','options'); ?>"
    data-three="<?php the_field('premium_color_price','options'); ?>"
    data-four="<?php the_field('premium_color_price_max','options'); ?>"
    class="configurator <?php if($trailer) { ?>preload<?php } ?>">

    <div class="trailer-select">
        <div class="lifestyle-select">
            <div class="row no-gutters justify-content-center">
                <div class="col-sm-6">
                    <div class="lifestyle-button" style="background-image: url(<?php the_field('cargo_background_image'); ?>);" data-panel="cargo">
                        <h3>Cargo</h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="lifestyle-button" style="background-image: url(<?php the_field('racing_background_image'); ?>);" data-panel="racing">
                        <h3>Racing</h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="lifestyle-button" style="background-image: url(<?php the_field('commercial_background_image'); ?>);" data-panel="commercial">
                        <h3>Commercial</h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="lifestyle-button" style="background-image: url(<?php the_field('recreational_background_image'); ?>);" data-panel="recreational">
                        <h3>Recreational</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-cargo">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <?php
                    $cargo = get_field('cargo');
                    if( $cargo ):
                        $i = 0;
                        foreach( $cargo as $post ):
                            $i++;
                            setup_postdata($post);
                            ?>
                            <div class="col-sm-4 col-6 d-flex">
                                <?php
                                $trailer_image = get_field('trailer_image');
                                $slug = $post->post_name;
                                ?>
                                <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                    <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                    <?php the_field('page_title'); ?>
                                </a>
                            </div>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <div class="close-trailer-select d-flex align-items-center justify-content-center">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
        <div class="panel panel-racing">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <?php
                    $racing = get_field('racing');
                    if( $racing ):
                        $i = 0;
                        foreach( $racing as $post ):
                            $i++;
                            setup_postdata($post);
                            ?>
                            <div class="col-sm-4 col-6 d-flex">
                                <?php
                                $trailer_image = get_field('trailer_image');
                                $slug = $post->post_name;
                                ?>
                                <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                    <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                    <?php the_field('page_title'); ?>
                                </a>
                            </div>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <div class="close-trailer-select d-flex align-items-center justify-content-center">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
        <div class="panel panel-commercial">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <?php
                    $commercial = get_field('commercial');
                    if( $commercial ):
                        $i = 0;
                        foreach( $commercial as $post ):
                            $i++;
                            setup_postdata($post);
                            ?>
                            <div class="col-sm-4 col-6 d-flex">
                                <?php
                                $trailer_image = get_field('trailer_image');
                                $slug = $post->post_name;
                                ?>
                                <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                    <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                    <?php the_field('page_title'); ?>
                                </a>
                            </div>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <div class="close-trailer-select d-flex align-items-center justify-content-center">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
        <div class="panel panel-recreational">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <?php
                    $recreational = get_field('recreational');
                    if( $recreational ):
                        $i = 0;
                        foreach( $recreational as $post ):
                            $i++;
                            setup_postdata($post);
                            ?>
                            <div class="col-sm-4 col-6 d-flex">
                                <?php
                                $trailer_image = get_field('trailer_image');
                                $slug = $post->post_name;
                                ?>
                                <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                    <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                    <?php the_field('page_title'); ?>
                                </a>
                            </div>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <div class="close-trailer-select d-flex align-items-center justify-content-center">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="trailer-image large-screen" data-original="<?php echo $image['url']; ?>">
            <?php if($trailer): ?>
                <img class="base" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            <?php endif; ?>
            <div class="front"></div>
            <div class="back"></div>
            <div class="stripe"></div>
        </div>

        <div class="row">
            <div class="col-lg-6 tools-container">
                <div class="tools">
                    <?php if($trailer): ?>
                        <h1><?php echo $title; ?></h1>
                    <?php endif; ?>

                    <?php if($text = get_field('switch_button_text')): ?>
                        <div class="buttons left switch-trailer">
                            <a class="button" id="switch-model" href="#">
                                <span><?php echo $text; ?></span>
                                <i class="far fa-angle-right"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="trailer-image mobile">
                        <?php if($trailer): ?>
                            <img class="base" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                        <?php endif; ?>
                        <div class="front"></div>
                        <div class="back"></div>
                        <div class="stripe"></div>
                    </div>

                    <form class="form">
                        <?php if($size): ?>
                            <div class="option">
                                <hgroup>
                                    <h2>Trailer Size</h2>

                                    <?php if($specs): ?>
                                        <div class="buttons">
                                            <a class="button" href="<?php echo $specs['url']; ?>" target="_blank">
                                                <span>Trailer Size Specs</span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </hgroup>
                                <select data-name="size">
                                    <?php foreach($size as $s): ?>
                                        <option value="<?php echo $s['size']; ?>"><?php echo $s['size']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <?php if($front): ?>
                            <div class="option">
                                <hgroup>
                                    <h2>Front Color</h2>
                                </hgroup>
                                <select data-name="front" class="color" data-update="front">
                                    <?php
                                    foreach($front as $f): 
                                        var_dump($f); 
                                        $image  = wp_get_attachment_url($f['color_overlay']);
                                        $swatch = $f['color_swatch'];
                                        ?>
                                        <option 
                                            value="<?php echo $f['color_name']; ?>"
                                            data-background="<?php echo $swatch; ?>"
                                            data-text-color="<?php echo $f['text_color']; ?>"
                                            data-premium="<?php echo $f['premium_color']; ?>"
                                            data-image="<?php echo $image; ?>">
                                            <?php echo $f['color_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <?php if($back): ?>
                            <div class="option">
                                <hgroup>
                                    <h2>Rear Color</h2>
                                </hgroup>
                                <select data-name="rear" class="color" data-update="back">
                                    <?php
                                    foreach($back as $f): 
                                        $image  = wp_get_attachment_url($f['color_overlay']);
                                        $swatch = wp_get_attachment_url($f['color_swatch']);
                                        ?>
                                        <option 
                                            value="<?php echo $f['color_name']; ?>"
                                            data-background="<?php echo $swatch; ?>"
                                            data-text-color="<?php echo $f['text_color']; ?>"
                                            data-premium="<?php echo $f['premium_color']; ?>"
                                            data-image="<?php echo $image; ?>">
                                            <?php echo $f['color_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <?php if($stripe): ?>
                            <div class="option">
                                <hgroup>
                                    <h2>Diagonal Stripe</h2>
                                </hgroup>
                                <select data-name="stripe" class="color" data-update="stripe">
                                    <option value="None">None</option>
                                    <?php 
                                    foreach($stripe as $f): 
                                        $image  = wp_get_attachment_url($f['color_overlay']['ID']);
                                        $swatch = wp_get_attachment_url($f['color_swatch']['ID']);
                                        ?>
                                        <option 
                                            value="<?php echo $f['color_name']; ?>"
                                            data-background="<?php echo $swatch; ?>"
                                            data-text-color="<?php echo $f['text_color']; ?>"
                                            data-premium="<?php echo $f['premium_color']; ?>"
                                            data-image="<?php echo $image; ?>">
                                            <?php echo $f['color_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <?php if($packages): ?>
                            <div class="option">
                                <hgroup>
                                    <h2>Packages</h2>
                                    <?php if($specs): ?>
                                        <div class="buttons">
                                            <a href="<?php echo $specs['url']; ?>" class="button" target="_blank">Base Trailer Options</a>
                                        </div>
                                    <?php endif; ?>
                                </hgroup>
                                <?php foreach($packages as $p): ?>
                                    
                                    <?php if(!get_field('price_type', $p->ID)): ?>
                                        <?php if($price = get_field('price', $p->ID)): ?>
                                        <div class="package has-price" data-price="<?php echo $price; ?>" data-name="<?php echo $p->post_name; ?>">
                                        <?php else: ?>
                                        <div class="package" data-name="<?php echo $p->post_name; ?>">
                                        <?php endif; ?>
                                    <?php 
                                    else: 
                                        $min    = get_field('minimum_price', $p->ID);
                                        $max    = get_field('maximum_price', $p->ID);
                                        if($min && $max): ?>
                                        <div 
                                            class="package has-price has-price-range" 
                                            data-min-price="<?php echo $min; ?>" 
                                            data-max-price="<?php echo $max; ?>"
                                            data-name="<?php echo $p->post_name; ?>">
                                        <?php else: ?>
                                        <div class="package" data-name="<?php echo $p->post_name; ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                        
                                        <?php if(get_field('does_this_change_the_base_trailer_image', $p->ID)): ?>
                                        <div class="new-base" data-image="<?php the_field('new_base_image', $p->ID); ?>"></div>
                                        <?php endif; ?>

                                        <div class="control">
                                            <i class="far fa-plus"></i>
                                            <i class="far fa-minus"></i>
                                        </div>
                                        <div class="contents">
                                            <h3><?php echo $p->post_title; ?></h3>
                                            <?php if(have_rows('options', $p->ID)): ?>
                                                <ul>
                                                    <?php while(have_rows('options', $p->ID)): the_row(); ?>
                                                        <?php if(get_sub_field('option_description')): ?>
                                                            <li class="tooltip">
                                                                <span><?php the_sub_field('option_name'); ?></span>
                                                                <i class="far fa-info-circle"></i>
                                                                <div class="tip">
                                                                    <span><?php the_sub_field('option_description'); ?></span>
                                                                </div>
                                                            </li>
                                                        <?php else: ?>
                                                            <li><?php the_sub_field('option_name'); ?></li>
                                                        <?php endif; ?>
                                                    <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </form>
                </div>

            </div>
            <div class="col-lg-6 summary-container">

                <div class="summary">

                    <div class="trailer-image small-screen">
                        <?php if($trailer): ?>
                            <img class="base" src="<?php echo $second_image['url']; ?>" alt="<?php echo $second_image['alt']; ?>">
                        <?php endif; ?>
                        <div class="front"></div>
                        <div class="back"></div>
                        <div class="stripe"></div>
                    </div>
                    <h2>Your Trailer Summary <span class="close-summary"><i class="far fa-edit"></i></span></h2>

                    <?php if($tprice): ?>
                    <div class="summary-item has-price">
                    <?php else: ?>
                    <div class="summary-item">
                    <?php endif; ?>
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>Trailer</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="name">
                                    <?php echo $title; ?>
                                    <?php if($tprice): ?>
                                        <span class="price" data-pricing="<?php echo $tprice; ?>"></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>Trailer Size</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="size"></p>
                            </div>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>Front Color</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="front"></p>
                            </div>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>Rear Color</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="rear"></p>
                            </div>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>Diagonal Stripe</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="stripe"></p>
                            </div>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>Package</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="package">None</p>
                            </div>
                        </div>
                    </div>
                    <?php if($tprice): ?>
                    <div class="summary-item total">
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>MSRP</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="msrp" data-msrp="<?php echo $tprice; ?>"></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row button-container">
                        <div class="col-xl-6 offset-xl-6 col-lg-8 offset-lg-4">
                            <div class="buttons modal-controls">
                                <a data-trigger="share" class="button white-text" href="#">Save &amp; Share</a>
                                <a data-trigger="quote" class="button orange" href="#">Get a Quote</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="mobile-buttons">
        <div class="buttons">
            <a href="#" data-trigger="summary" class="button white-text">View Summary</a>
            <a href="#" data-trigger="quote" class="button orange">Get a Quote</a>
        </div>
    </div>
</section>

<div class="modal">
    <div class="modal-content">
        <hgroup>
            <h2 class="advanced">Get a Quote</h2>
            <h2 class="simple">Save &amp; Share</h2>
        </hgroup>
        <div class="form modal-form">
            <?php echo do_shortcode('[gravityform id="5" title="false" description="false" ajax="true"]'); ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>
