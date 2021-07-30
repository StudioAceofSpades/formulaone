<?php $bg = get_field('background_image'); ?>

<div class="hero-wrapper hero-default" style="background-image: url(<?php echo ($bg['url'])?>)">
    <?php
    if (get_field('page_title')):
        echo ('<h1>'.get_field('page_title').'</h1>');
    endif;
    if (get_field('page_subtitle')):
        echo('<h2>'.get_field('page_subtitle').'</h2>');
    endif;
    if (get_field('text')):
        the_field('text');
    endif;
    if(have_rows('buttons')):
        echo('<div class="buttons left">');
        while(have_rows('buttons')):
            the_row();
            $link = get_sub_field('link'); 
            $color = get_sub_field('button_color');
            echo('<a href="'.$link['url'].'" class="button '.$color.'" target="'.$link['target'].'">'.$link['title'].'</a>');
        endwhile;
        echo('</div>');
    endif;
    ?>
</div>