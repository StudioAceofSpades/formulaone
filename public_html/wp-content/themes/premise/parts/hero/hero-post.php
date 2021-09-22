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

$categories = get_the_category();
$category_list = '';
foreach($categories as $category) {
    $link = get_category_link($category);
    $category_list .= '<a href="'.$link.'">'.$category->name.'</a>, ';
}
$category_list = substr($category_list, 0, -2);

?>

<div class="hero-wrapper hero-post hero-default" <?php echo $bg_image_output; ?>>

    <?php echo $video_output; ?>
    
    <div class="hero-content">
        <h1><?php the_title(); ?></h1>

        <?php if($category_list): ?>
        <h2>Categories: <?php echo $category_list; ?></h2>
        <?php endif; ?>
        
        <div class="meta">
            <span class="author"><?php the_author(); ?></span>
            <span class="divider"></span>
            <span class="date"><?php the_time('F j, Y'); ?></span>
        </div>
    </div>

</div>
