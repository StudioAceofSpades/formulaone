<?php
$term = 'options';
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

<div class="hero-wrapper hero-post hero-default" <?php echo $bg_image_output; ?>>

    <?php echo $video_output; ?>
    
    <div class="hero-content">
        <h1><?php the_field('page_title','options'); ?></h1>

        <?php if($subheader = get_field('subheader','options')): ?>
        <h2><?php echo $subheader; ?></h2>
        <?php endif; ?>
    </div>

</div>
