<?php
if (have_rows('images')): 
    $imageurl = array();
    while(have_rows('images') ): the_row();
        $image = get_sub_field('image');
        $image_urls[] = $image;
    endwhile;
endif;

array_unshift($image_urls, "");
unset($image_urls[0]);

$total_images = sizeof($image_urls);
$fancy_slides = floor($total_images/7);
$simple_slide_image_count = $total_images % 7;

/*
echo ("Total images: " . $total_images);
echo "<br>";
echo ("Fancy slides: " . $fancy_slides);
echo "<br>";
echo ("Simple slide image count: " . $simple_slide_image_count);
echo "<br>";
*/

// Build slides
$current_slide_number = 1;
$image_number_key = 1;
$max_images_per_slide = 7;

//Make Fancy Slide
while ($current_slide_number <= $fancy_slides) {
    echo ("<br>Fancy Slide #" . $current_slide_number . "<br>");

    $current_slide_image_number = 1;

    while ($current_slide_image_number <= $max_images_per_slide) {
        echo ("Image #" . $image_number_key . ": " . $image_urls[$image_number_key] . "<br>");
        $image_number_key++;
        $current_slide_image_number++;
    }

    if ($current_slide_image_number == $max_images_per_slide) {
        $current_slide_image_number = 1;
    }

    $current_slide_number++;
}

// Make Simple slide
if ($simple_slide_image_count != 0) {
    $simple_slide_image_key_start = $total_images - $simple_slide_image_count + 1;

    $simple_slide .= '<div>'; // Open slick div
    $simple_slide = '<div class="row justify-content-center">';

    $current_simple_slide_image_count = 0;
    $row_breaker = '<!--ROW BREAKER--></div><div class="row justify-content-center">';

    while ($image_urls[$simple_slide_image_key_start]) {

        // Col logic
       if (in_array($simple_slide_image_count, [3,5,6], true)) {
            $col_class = "col-sm-4";
        } elseif ($simple_slide_image_count == 4) {
            $col_class = "col-sm-6";
        } else {
            $col_class = "col-sm-3";
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
            $simple_slide .= '<a href="#" class="box-image" style="background-image:url(' . $image_urls[$image_number_key] . ');"><i class="fas fa-expand-arrows-alt"></i></a>';
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
        <div class="container-fluid">
            <?php if($photo_title): ?>
                <div class="row">
                    <div class="col">
                        <h1><?php echo $photo_title; ?></h1>
                    </div>
                </div>
            <?php endif; ?>


            <?php echo $simple_slide; ?>

        </div>
    </div>
</div>

            <!--
            <div class="slick">
                <div>
                    <div class="d-none d-xl-block">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[0]; ?>);">
                                            <i class="fas fa-expand-arrows-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[1]; ?>);">
                                            <i class="fas fa-expand-arrows-alt"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[2]; ?>);">
                                            <i class="fas fa-expand-arrows-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="main box-image" style="background-image:url(<?php echo $imageurl[3]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[4]; ?>);">
                                            <i class="fas fa-expand-arrows-alt"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[5]; ?>);">
                                            <i class="fas fa-expand-arrows-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[6]; ?>);">
                                            <i class="fas fa-expand-arrows-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-md-block d-xl-none">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[0]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[1]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[2]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>

                            </div>
                            <div class="col-md-3">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[3]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[4]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[5]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[6]; ?>);">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->


<?php endif; ?>