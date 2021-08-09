<?php 
if(is_tax()) {
    $term = get_queried_object();
} else {
    $term = false;
}
$bg = get_field('background_image', $term); ?>

<div class="hero-wrapper hero-default" style="background-image: url(<?php echo ($bg['url'])?>)">
    <?php
    
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
