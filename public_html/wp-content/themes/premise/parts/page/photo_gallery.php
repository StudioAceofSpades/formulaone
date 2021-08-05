<?php
if (have_rows('images')): 
    while(have_rows('images') ): the_row();
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
// ON THE CLOSING STATEMENT LINE.

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
            $col_class = "col-md-4";
        } elseif ($simple_slide_image_count == 4) {
            $col_class = "col-md-6";
        } else {
            $col_class = "col-md-3";
        }

        // Row logic
        if (
            (in_array($simple_slide_image_count, [3,5,6], true)) && 
            ($current_simple_slide_image_count == 3)
        ) {
            $simple_slide .= $row_breaker;
        } elseif (
            ($simple_slide_image_count == 4) && 
            ($current_simple_slide_image_count == 2)
        ) {
            $simple_slide .= $row_breaker;
        } else {}

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

if(get_sub_field('gallery_title')):
    $photo_title = get_sub_field('gallery_title');
endif;

?>

<?php if (have_rows('images')): ?>
    <div class="gallery-page">
        <div class="slick-arrow-desktop prev d-none d-md-block"><i class="far fa-angle-left"></i></div>
        <div class="slick-arrow-desktop next d-none d-md-block"><i class="far fa-angle-right"></i></div>
        <div class="slick-arrow-mobile prev d-block d-md-none"><i class="far fa-angle-left"></i></div>
        <div class="slick-arrow-mobile next d-block d-md-none"><i class="far fa-angle-right"></i></div>

        <?php if($photo_title): ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1><?php echo $photo_title; ?></h1>
                    </div>
                </div>
            </div>
        <?php endif; ?>

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
                if (have_rows('images')): 
                    while(have_rows('images') ): the_row();
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
</div>

<?php endif; ?>