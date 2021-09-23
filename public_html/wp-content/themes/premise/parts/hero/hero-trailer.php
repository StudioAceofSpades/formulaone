<?php
if(is_tax()) {
    $term = get_queried_object();
} else {
    $term = false;
}

$background = create_bg($term);
if(isset($background['image'])) {
    $bg_image_output = 'style="background-image: url(';
    $bg_image_output .= $background['image']['sizes']['hero'];
    $bg_image_output .=');"';
} else {
    $video_output = '<video playsinline autoplay muted loop poster="' . $background['cover'] . '">';
    $video_output .= '<source src="' . $background['webm'] . '" type="video/webm">';
    $video_output .= '<source src="' . $background['mp4'] . '" type="video/mp4">';
    $video_output .= '</video>';
}
?>

<div class="hero-wrapper hero-trailer" <?php echo $bg_image_output; ?>>
    <?php echo $video_output; ?>

    <div class="title-wrapper">
        <?php
        if (get_field('page_title')):
            echo ('<h1>'.get_field('page_title').'</h1>');
        endif;
        if (get_field('page_subtitle')):
            echo('<h2>'.get_field('page_subtitle').'</h2>');
        endif;
        ?>
    </div>
    <?php include(locate_template('parts/hero/find-a-dealer.php')); ?>
</div>
