<?php
if(is_tax()) {
    $term = get_queried_object();
} else {
    $term = false;
}

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

<div class="hero-wrapper hero-default" <?php echo $bg_image_output; ?>>
    <?php
    echo $video_output;

    if ($title = get_field('page_title', $term)):
        echo ('<h1>'.$title.'</h1>');
    endif;

    if ($subtitle = get_field('page_subtitle', $term)):
        echo('<h2>'.$subtitle.'</h2>');
    endif;

    if ($text = get_field('text', $term)):
        echo $text;
    endif;

    if(have_rows('buttons', $term)):
        echo('<div class="buttons left">');
        while(have_rows('buttons', $term)):
            the_row();
            
            $link   = get_sub_field('link'); 
            $color  = get_sub_field('button_color');

            echo('<a href="'.$link['url'].'" class="button '.$color.'" target="'.$link['target'].'">'.$link['title'].'</a>');
        endwhile;
        echo('</div>');
    endif;
    ?>

</div>
