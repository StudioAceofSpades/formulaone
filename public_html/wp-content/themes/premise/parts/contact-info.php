<?php
if(get_field('contact_header','options')):
    echo('<h3>'.get_field('contact_header','options').'</h3>');
endif;
if (have_rows('contact_info','options')):
    echo '<ul class="contact-info">';
    while(have_rows('contact_info','options')):
        the_row();
        $link_end = '</a>';
        if(get_sub_field('contact_type') == 'address') {
            $address = str_replace(' ', '+', get_sub_field('icon_text','options'));
            $link = '<a href="https://www.google.com/maps/place/' . $address . '" target="_blank">';
        } elseif(get_sub_field('contact_type') == 'phonefax') {
            $phone_num = str_replace(array(' ','(',')','-','.','+'),'', get_sub_field('icon_text','options'));
            $link = '<a href="tel:' . $phone_num . '" target="_blank">';
        } else {
            $link = $link_end = "";
        }
        echo('<li><i class="' . get_sub_field('icon','options') . '"></i>' . $link . get_sub_field('icon_text','options') . $link_end . '</li>');
    endwhile;
    echo '</ul>';
endif;
?>
