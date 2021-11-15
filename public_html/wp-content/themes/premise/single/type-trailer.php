<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$related = get_field('associated_buildable_trailer');

get_header(); ?>

<div id="single-trailer">
    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

    <div id="trailer-intro" class="scroll-to">
        <div class="container-fluid">
            <div class="row">
                <div class="col d-lg-none">
                    <?php
                    if (get_field('trailer_image')):
                        $image = get_field('trailer_image');
                        ?>
                        <img src="<?php echo $image['url']; ?>" class="img-fluid trailer-image" alt="<?php echo $image['title']; ?>">
                        <?php
                    endif;
                    ?>
                </div>
                <div class="col-xl col-lg-7">
                    <?php
                    if (get_field('introduction')):
                        the_field('introduction');
                    endif;
                    ?>
                    <?php if($related): ?>
                    <div class="buttons left">
                        <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $related[0]->post_name; ?>" class="button orange">Build Yours</a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-xl col-lg-5 d-none d-lg-block">
                    <?php
                    if (get_field('trailer_image')):
                        $image = get_field('trailer_image');
                        ?>
                        <img src="<?php echo $image['url']; ?>" class="img-fluid trailer-image" alt="<?php echo $image['title']; ?>">
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    if( have_rows('specifications') ):
        $num_of_sizes = count(get_field('specifications'));
        ?>
        <div id="specs" class="scroll-to">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h2 class="text-center">Specifications</h2>
                        <?php
                        if (get_field('spec_intro')) {
                            the_field('spec_intro');
                        }
                        if ($num_of_sizes > 1):
                            echo '<form>';
                            echo '<label for="trailer-size">Trailer Size</label>';
                            echo '<select id="trailer-size">';
                            while( have_rows('specifications') ) : the_row();
                                $size = get_sub_field('size');
                                $size_option_value = sanitize_title($size);
                                echo ('<option value="' . $size_option_value . '">' . $size . '</option>');
                                if( have_rows('specification') ):
                                    $i = 0;
                                    while( have_rows('specification') ) : the_row();
                                        $spec[$size_option_value][$i]['name'] = get_sub_field('name');
                                        $spec[$size_option_value][$i]['value'] = get_sub_field('value');
                                        $i++;
                                    endwhile;
                                endif;
                            endwhile;
                            echo '</select>';
                            echo '</form>';
                            foreach($spec as $size_option_value => $specs):
                                $row_breaker = 0;
                                $current_spec = 0;
                                $total_specs_per_size = sizeof($specs);
                                ?>
                                <div id="<?php echo $size_option_value; ?>" class="trailer-spec-table">
                                    <div class="row">
                                        <?php
                                        foreach ($specs as $spec_line):
                                            $row_breaker++;
                                            $current_spec++;
                                            $col_size_name = 'name col-md-4 col-9';
                                            $col_size_val = 'val col-md-2 col-3';
                                            if ( ($total_specs_per_size - $current_spec == 0) && ($total_specs_per_size % 2 != 0) ) {
                                                $col_size_name .= ' last';
                                                $col_size_val .= ' last';
                                            }
                                            echo ('<div class="' . $col_size_name . '">' . $spec_line['name'] . '</div>');
                                            $row_breaker++;
                                            echo ('<div class="' . $col_size_val . '">' . $spec_line['value'] . '</div>');
                                            if (($row_breaker % 4 == 0) && ($current_spec != $total_specs_per_size)) {
                                                echo '</div><div class="row">';
                                                $n = 0;
                                            }
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <div class="trailer-spec-table d-block">
                                <div class="row">
                                    <?php
                                    $row_breaker = 0;
                                    $current_spec = 0;
                                    while( have_rows('specifications') ) : the_row();
                                        $total_specs = sizeof(get_sub_field('specification'));
                                        if( have_rows('specification') ):
                                            while( have_rows('specification') ) : the_row();
                                                $row_breaker++;
                                                $current_spec++;
                                                $col_size_name = 'name col-md-4 col-9';
                                                $col_size_val = 'val col-md-2 col-3';
                                                if ( ($total_specs - $current_spec == 0) && ($total_specs % 2 != 0) ) {
                                                    $col_size_name .= ' last';
                                                    $col_size_val .= ' last';
                                                }
                                                $name = get_sub_field('name');
                                                $value = get_sub_field('value');
                                                echo ('<div class="' . $col_size_name . '">' . $name . '</div>');
                                                $row_breaker++;
                                                echo ('<div class="' . $col_size_val . '">' . $value . '</div>');
                                                if (($row_breaker % 4 == 0) && ($current_spec != $total_specs)) {
                                                    echo '</div><div class="row">';
                                                    $n = 0;
                                                }
                                            endwhile;
                                        endif;
                                    endwhile;
                                    ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endif;
    ?>

    <?php if( have_rows('features') ): ?>
        <div id="features" class="standard-features-options scroll-to">
            <div class="row no-gutters">
                <div class="col">
                    <h1>Standard Features</h1>
                </div>
            </div>
            <?php
            while( have_rows('features') ) : the_row();
                $features[] = get_sub_field('feature');
            endwhile;
            $total_features = sizeof($features);
            $remainder_features = $total_features % 3;
            $features_third = ceil($total_features / 3);
            $double_feature = $features_third * 2;
            array_unshift($features, "dummy");
            unset($image_urls[0]);
            ?>
            <div class="gray-bg">
                <div class="row no-gutters">
                    <div class="col-md-4 d-block d-md-flex">
                        <ul>
                            <?php
                            $i = 1;
                            while( have_rows('features') ) : the_row();
                                echo ('<li>' . $features[$i] . '</li>');
                                if (($i == $features_third) || ($i == $double_feature)) {
                                    echo '</ul></div><div class="col-md-4 d-block d-md-flex"><ul>';
                                }
                                $i++;
                            endwhile;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if( have_rows('options_upgrades') ): ?>
        <div id="options" class="standard-features-options scroll-to">
            <div class="row no-gutters">
                <div class="col">
                    <h1>Options &amp; Upgrades</h1>
                </div>
            </div>
            <?php
            while( have_rows('options_upgrades') ) : the_row();
                $options[] = get_sub_field('option_upgrade');
            endwhile;
            $total_options = sizeof($options);
            $remainder_options = $total_options % 3;
            $options_third = ceil($total_options / 3);
            $double_option = $options_third * 2;
            array_unshift($options, "dummy");
            unset($image_urls[0]);
            ?>
            <div class="gray-bg">
                <div class="row no-gutters">
                    <div class="col-md-4 d-block d-md-flex">
                        <ul>
                            <?php
                            $i = 1;
                            while( have_rows('options_upgrades') ) : the_row();
                                echo ('<li>' . $options[$i] . '</li>');
                                if (($i == $options_third) || ($i == $double_option)) {
                                    echo '</ul></div><div class="col-md-4 d-block d-md-flex"><ul>';
                                }
                                $i++;
                            endwhile;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 col-sm-12">
                        <div class="buttons">
                            <a href="<?php bloginfo('url'); ?>/build-yours" class="button orange">Build Your Perfect Formula</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php
    if ( (have_rows('standard_colors')) || (have_rows('optional_colors')) ):
        if (have_rows('optional_colors')) {
            $has_optional = "has-optional";
        }
        ?>
        <div id="colors" class="scroll-to">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1>Available Colors</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if (get_field('trailer_image')):
                            $image = get_field('trailer_image');
                            ?>
                            <img src="<?php echo $image['url']; ?>" class="img-fluid trailer-image-color" alt="<?php echo $image['title']; ?>">
                            <?php
                        endif;
                        ?>
                    </div>
                    <div class="col-md-6">
                        <div class="d-md-flex <?php echo $has_optional; ?>">
                            <div class="standard">
                                <p>Standard colors</p>
                                <?php
                                $n = 0;
                                while (have_rows('standard_colors')): the_row();
                                    $n++;
                                    $color_name = get_sub_field('color_name');
                                    $color = get_sub_field('color');
                                    ?>
                                    <div class="color">
                                        <div style="background-image: url(<?php echo $color; ?>);"></div>
                                        <p><?php echo $color_name; ?></p>
                                    </div>
                                    <?php
                                    if($n % 3 == 0) {
                                        echo '<div class="break"></div>';
                                    }
                                endwhile;
                                ?>
                            </div>
                            <?php if (have_rows('optional_colors')): ?>
                                <div class="gutter"></div>
                                <div class="optional">
                                    <p>Optional colors</p>
                                    <?php
                                    while (have_rows('optional_colors')): the_row();
                                        $color_name = get_sub_field('color_name');
                                        $color = get_sub_field('color');
                                        ?>
                                        <div class="color">
                                            <div style="background-image: url(<?php echo $color; ?>);"></div>
                                            <p><?php echo $color_name; ?></p>
                                        </div>
                                        <?php
                                    endwhile;
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (have_rows('photos')): ?>
        <div id="photos" class="scroll-to">
            <?php
            if (have_rows('photos')): 
                while(have_rows('photos') ): the_row();
                    $image = get_sub_field('image');
                    $image_urls[] = $image;
                endwhile;
            endif;

            array_unshift($image_urls, "dummy");
            unset($image_urls[0]);

            $max_images_per_slide = 7;
            $total_images = sizeof($image_urls);
            $total_fancy_slides = floor($total_images / $max_images_per_slide);
            $simple_slide_image_count = $total_images % $max_images_per_slide;

            // Build slides
            $current_slide_number = 1;
            $image_number_key = 1;

            //Make Fancy Slide
            while ($current_slide_number <= $total_fancy_slides) {
                $current_slide_image_number = 1;

                while ($current_slide_image_number <= $max_images_per_slide) {
                    $fancy_slide_image_loop[] = $image_urls[$image_number_key];
                    $fancy_slide_image_loop_small_desktop[] = $image_urls[$image_number_key];

                    $image_number_key++;
                    $current_slide_image_number++;
                }

                if ($current_slide_image_number == $max_images_per_slide) {
                    $current_slide_image_number = 1;
                }

                // Bump the output array so I can use next() for the structure.
                if ($current_slide_number == 1) {
                    array_unshift($fancy_slide_image_loop, "dummy");
                    reset($fancy_slide_image_loop);
                    array_unshift($fancy_slide_image_loop_small_desktop, "dummy");
                    reset($fancy_slide_image_loop_small_desktop);
                }

                $current_slide_number++;

            $fancy_slide .= '<div class="popup">'; // Start slick div.

// EVERYTHING USING THE HEREDOC SYNTAX BELOW
// MUST NOT HAVE ANY TABS OR SPACES
// ON THE CLOSING STATEMENT LINE
// OTHER WISE SHIT WONT WORK.

// Start large desktop slide population.
$fancy_slide .= <<<END
<div class="d-none d-xl-block">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col">
                    <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    );"><i class="fas fa-expand-arrows-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    );"><i class="fas fa-expand-arrows-alt"></i></a>
                </div>
                <div class="col-md-6">
                    <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    );"><i class="fas fa-expand-arrows-alt"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop);
$fancy_slide .= <<<END
            " class="main box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-6">
                    <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    );"><i class="fas fa-expand-arrows-alt"></i></a>
                </div>
                <div class="col-md-6">
                    <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    );"><i class="fas fa-expand-arrows-alt"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop);
$fancy_slide .= <<<END
                    );"><i class="fas fa-expand-arrows-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
END;
// End large desktop slide population.

// Start small desktop slide population.
$fancy_slide .= <<<END
<div class="d-none d-md-block d-xl-none">
    <div class="row">
        <div class="col-md-3">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
        <div class="col-md-3">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
        <div class="col-md-3">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
        <div class="col-md-3">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
        <div class="col-md-4">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
        <div class="col-md-4">
            <a href="
END;
$fancy_slide .= next($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            " class="box-image" style="background-image:url(
END;
$fancy_slide .= current($fancy_slide_image_loop_small_desktop);
$fancy_slide .= <<<END
            );"><i class="fas fa-expand-arrows-alt"></i></a>
        </div>
    </div>
</div>
END;
// End small desktop slide population.

            $fancy_slide .= "</div>"; // End slick div.

            }

            // Make Simple slide
            if ($simple_slide_image_count != 0) {
                $simple_slide_image_key_start = $total_images - $simple_slide_image_count + 1;

                $simple_slide .= '<div class="popup">'; // Open slick div
                $simple_slide .= '<div class="row justify-content-center">';

                $current_simple_slide_image_count = 0;
                $row_breaker = '</div><div class="row justify-content-center">';

                while ($image_urls[$simple_slide_image_key_start]) {

                    // Col logic
                if (in_array($simple_slide_image_count, [3,5,6], true)) {
                        $col_class = "col-md-3";
                    } elseif ($simple_slide_image_count == 4) {
                        $col_class = "col-md-3";
                    } else {
                        $col_class = "col-md-3";
                    }

                    // Row logic
                    /*
                    if (
                        (in_array($simple_slide_image_count, [3,4,5,6], true)) && 
                        ($current_simple_slide_image_count == 3)
                    ) {
                        $simple_slide .= $row_breaker;
                    } elseif (
                        ($simple_slide_image_count == 4) && 
                        ($current_simple_slide_image_count == 2)
                    ) {
                        $simple_slide .= $row_breaker;
                    } else {}
                    */

                    // Create col and image/link
                    $simple_slide .= '<div class="' . $col_class . '">';
                        $simple_slide .= '<a href="' . $image_urls[$image_number_key] . '" class="box-image" style="background-image:url(' . $image_urls[$image_number_key] . ');"><i class="fas fa-expand-arrows-alt"></i></a>';
                    $simple_slide .= '</div>';
                    
                    $current_simple_slide_image_count++;
                    $image_number_key++;
                    $simple_slide_image_key_start++;
                }

                $simple_slide .= '</div>';
                $simple_slide .= '</div>'; // Close slick div
            }

            ?>

            <?php if (have_rows('photos')): ?>
                <div class="gallery-page">
                    <div class="slick-arrow-desktop prev d-none d-md-block"><i class="far fa-angle-left"></i></div>
                    <div class="slick-arrow-desktop next d-none d-md-block"><i class="far fa-angle-right"></i></div>
                    <div class="slick-arrow-mobile prev d-block d-md-none"><i class="far fa-angle-left"></i></div>
                    <div class="slick-arrow-mobile next d-block d-md-none"><i class="far fa-angle-right"></i></div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h1>Photo Gallery</h1>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="row no-gutters">
                            <div class="col">
                                <div class="slick photo-gallery-desktop">
                                    <?php echo $fancy_slide; ?>
                                    <?php echo $simple_slide; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-block d-md-none">
                        <div class="slick photo-gallery-mobile popup">
                            <?php
                            if (have_rows('photos')): 
                                while(have_rows('photos') ): the_row();
                                    $image = get_sub_field('image');
                                    ?>
                                    <div>
                                        <a href="<?php echo $image; ?>" class="box-image" style="background-image:url(<?php echo $image; ?>);"></a>
                                    </div>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="slick-dots"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if(have_rows('videos')): ?>
        <div id="video" class="scroll-to">
            <div class="container">
                <div class="row">
                    <?php 
                    $number = count(get_field('videos'));
                    if($number == 1) {
                        $class = 'col-md-8 offset-md-2';
                        $title = 'Video';
                    } elseif ($number == 2) {
                        $class = 'col-md-6';
                        $title = 'Videos';
                    } else {
                        $class = 'col-md-4';
                        $title = 'Videos';
                    }
                    ?>

                    <div class="col-12"><h1 class="text-center"><?php echo $title; ?></h1></div>
                    
                    <?php while(have_rows('videos')) : the_row(); ?>
                        <div class="<?php echo $class; ?>">
                            <?php $vid = get_sub_field('video'); ?>
                            <div class="video-container">
                                <?php echo $vid; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="request-a-quote" class="scroll-to">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1 class="text-center">Request A Quote</h1>
                    <?php echo do_shortcode('[gravityform id="4" title="false" description="false"]'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="jumplist d-none d-lg-block">
        <ul id="jumplist">
            <li><a href="#trailer-intro" class="jumplist-link"><span></span><i>Introduction</i></a></li>
            <?php
            if( have_rows('specifications') ) {
                echo '<li><a href="#specs" class="jumplist-link"><span></span><i>Specifications</i></a></li>';
            }
            if( have_rows('features') ) {
                echo '<li><a href="#features" class="jumplist-link"><span></span><i>Standard&nbsp;Features</i></a></li>';
            }
            if( have_rows('options_upgrades') ) {
                echo '<li><a href="#options" class="jumplist-link"><span></span><i>Options&nbsp;&amp;&nbsp;Upgrades</i></a></li>';
            }
            if ( (have_rows('standard_colors')) || (have_rows('optional_colors')) ) {
                echo '<li><a href="#colors" class="jumplist-link"><span></span><i>Available&nbsp;Colors</i></a></li>';
            }
            if (have_rows('photos')) {
                echo '<li><a href="#photos" class="jumplist-link"><span></span><i>Photo&nbsp;Gallery</i></a></li>';
            }
            if(get_field('video')) {
                echo '<li><a href="#video" class="jumplist-link"><span></span><i>Video</i></a></li>';
            }
            ?>
            <li class="jumplist-link"><a href="#request-a-quote"><span></span><i>Request&nbsp;A&nbsp;Quote</i></a></li>
        </ul>
    </div>

</div>
<?php get_footer(); ?>
