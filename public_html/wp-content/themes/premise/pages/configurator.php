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

    $second_image = $image;
}

get_header(); ?>

<section class="configurator <?php if($trailer) { ?>preload<?php } ?>">
    <div class="container">
        
        <div class="trailer-image large-screen">
            <?php if($trailer): ?>
            <img class="base" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            <?php endif; ?>
            <div class="front"></div>
            <div class="back"></div>
            <div class="stripe"></div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                
                <div class="tools">
                    
                    <?php if($trailer): ?>
                    <h1><?php echo $title; ?></h1>
                    <?php endif; ?>
                    
                    <?php if($text = get_field('switch_button_text')): ?>
                    <div class="buttons left switch-trailer">
                        <a class="button" href="#">
                            <span><?php echo $text; ?></span>
                            <i class="far fa-angle-right"></i>
                        </a>
                    </div>
                    <?php endif; ?>
        
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
                            <div class="package" data-name="<?php echo $p['package_name']; ?>">
                                <div class="control">
                                    <i class="far fa-plus"></i>
                                    <i class="far fa-minus"></i>
                                </div>
                                <div class="contents">
                                    <h3><?php echo $p['package_name']; ?></h3>
                                    <?php if($p['package_items']): ?>
                                    <ul>
                                        <?php foreach($p['package_items'] as $i): ?>
                                            <?php if($i['item_description']): ?>
                                            <li class="tooltip">
                                                <span><?php echo $i['item_name']; ?></span>
                                                <i class="far fa-info-circle"></i>
                                                <div class="tip">
                                                    <span><?php echo $i['item_description']; ?></span>
                                                </div>
                                            </li>
                                            <?php else: ?>
                                            <li><?php echo $i['item_name']; ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
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
            <div class="col-sm-6">

                <div class="summary">

                    <div class="trailer-image small-screen">
                        <?php if($trailer): ?>
                        <img class="base" src="<?php echo $second_image['url']; ?>" alt="<?php echo $second_image['alt']; ?>">
                        <?php endif; ?>
                        <div class="front"></div>
                        <div class="back"></div>
                        <div class="stripe"></div>
                    </div>
                    <h2>Your Trailer Summary</h2>
                    <div class="summary-item">
                        <div class="row">
                            <div class="col-xl-6 col-lg-4">
                                <h3>Trailer</h3>
                            </div>
                            <div class="col-xl-6 col-lg-8">
                                <p data-summary="name"><?php echo $title; ?></p>
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
                    <div class="row">
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
