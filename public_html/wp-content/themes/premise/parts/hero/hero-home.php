<?php
$background = create_bg();
if(isset($background['image'])) {
    $bg_image_output = 'style="background-image: url(';
    $bg_image_output .= $background['image'];
    $bg_image_output .=');"';
} else {
    $video_output = '<video playsinline autoplay muted loop poster="' . $background['cover'] . '">';
    $video_output .= '<source src="' . $background['webm'] . '" type="video/webm">';
    $video_output .= '<source src="' . $background['mp4'] . '" type="video/mp4">';
    $video_output .= '</video>';
}
?>

<div class="hero-wrapper hero-home" <?php echo $bg_image_output; ?>>
    <?php echo $video_output; ?>
    <h1><?php the_field('tagline'); ?></h1>
    <?php include(locate_template('parts/hero/find-a-dealer.php')); ?>
</div>