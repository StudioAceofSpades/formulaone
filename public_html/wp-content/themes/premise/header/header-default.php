<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); } ?>
<!DOCTYPE html>

<!--

Authors: Studio Ace of Spades
Website: http://studioaceofspades.com
E-Mail: jon@studioaceofspade.com
 
-->

<head>

    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
    <title><?php wp_title( '-', true, 'right' ); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
    
</head>

<body id="top-of-page" <?php body_class(); ?>>
    <header class="header cf">
        <nav class="secondary">
            <div class="container">
                <div class="row">
                    <a href="<?php bloginfo('url'); ?>" class="brand">
                        <?php if($image = get_field('logo','options')): ?>
                            <div class="formulaicon">
                                <img src="<?php echo $image['url']; ?>" alt="Formula Trailers">
                            </div>
                        <?php endif; ?>
                    </a>
                    <div class="col d-flex justify-content-end">
                        <div class="top-menu-links">
                            <?php if(have_rows('top_navigation','options')): ?>
                            <ul>
                                <?php 
                                while(have_rows('top_navigation','options')) : 
                                    the_row(); 
                                    $link = get_sub_field('menu_link'); 
                                    ?>
                                    <?php if(get_sub_field('has_dropdown','options')): ?>
                                        <li class="has-dropdown">
                                        <?php saos_output_link($link); ?>
                                        <?php if(have_rows('dropdown')): ?>
                                            <div class="dropdown">
                                                <ul class="dropdownitems">
                                                    <?php 
                                                    while(have_rows('dropdown','options')) : 
                                                        the_row();
                                                        $link = get_sub_field('dropdown_link'); ?> 
                                                         <li>
                                                            <?php saos_output_link($link); ?>
                                                        </li>                                        
                                                    <?php endwhile; ?>
                                                </ul>
                                            </div>
                                            <?php endif; ?>

                                        </li>
                                        <?php else: ?>
                                        <li>
                                            <?php saos_output_link($link); ?>
                                        </li>
                                     <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                        <div class="top-menu-social">
                            <ul>
                                <?php 
                                $phone_link = get_field('phone_number_link','options');
                                $phone      = get_field('phone_number','options');
                                if($phone && $phone_link): ?>
                                    <li><a class="phone" href="<?php echo $phone_link; ?>"><?php echo $phone; ?></a></li>
                                <?php endif; ?>

                                <?php if(have_rows('social_media', 'options')):
                                    while(have_rows('social_media', 'options')): the_row(); ?>
                                        <li>
                                            <a href="<?php the_sub_field('link'); ?>" target="_blank"><i class="fab fa-<?php the_sub_field('icon'); ?>"></i></a>
                                        </li>
                                    <?php
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                        </div>
                     </div>
                </div>
            </div>
        </nav>

        <nav class="main">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col d-flex flex-grow-1 justify-content-end">
                        <nav class="primary">
                            <div class="primary-links">
                                <?php if(have_rows('main_navigation','options')): ?>
                                    <ul>
                                        <?php 
                                        while(have_rows('main_navigation','options')) : 
                                            the_row(); 
                                            $link = get_sub_field('main_menu_link'); ?>
                                            <?php if(get_sub_field('has_dropdown','options')): ?>
                                            <li class="has-dropdown">
                                            <?php saos_output_link($link); ?>
                                            <?php if(have_rows('dropdown')): ?>
                                                <div class="dropdown">
                                                    <ul class="dropdownitems">
                                                        <?php 
                                                        while(have_rows('dropdown','options')) : 
                                                            the_row();
                                                            $link = get_sub_field('dropdown_link'); ?> 
                                                             <li>
                                                                <?php saos_output_link($link); ?>
                                                            </li>                                        
                                                        <?php endwhile; ?>
                                                    </ul>
                                                </div>
                                                <?php endif; ?>

                                            </li>
                                            <?php else: ?>
                                            <li>
                                                <?php saos_output_link($link); ?>
                                            </li>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </nav>
<div class="mobile-nav">
    
    <a class="mobile-trigger" href="#"><i class="far fa-bars"></i></a>

    <nav class="mobile-navigation">
        
        <?php if(have_rows('main_navigation','options')): ?>
        <ul>
            <?php 
            while(have_rows('main_navigation','options')) : 
                the_row(); 
                $link = get_sub_field('main_menu_link');
               
                if(get_sub_field('has_dropdown','options')): 
                ?>
                <li class="has-dropdown">
                    <div class="submenu-title">
                            
                        <a href="#" class="submenu-toggle">
                            <i class="far fa-plus"></i>
                            <i class="far fa-minus"></i>
                        </a>

                        <?php saos_output_link($link); ?>

                        <?php if(have_rows('dropdown')): ?>
                        <div class="dropdown">
                            <ul class="dropdownitems">
                            <?php while(have_rows('dropdown','options')) : the_row(); ?>
                                <li><?php saos_output_link(get_sub_field('dropdown_link')); ?></li>
                            <?php endwhile; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                    </div>
                </li>
                <?php else: ?>
                    <li><?php saos_output_link($link); ?></li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>

        <?php if(have_rows('top_navigation','options')): ?>
        <ul class="secondnav">
            <?php 
            while(have_rows('top_navigation','options')) : 
                the_row(); 
                $link = get_sub_field('menu_link'); 
                
                if(get_sub_field('has_dropdown','options')): ?>
                    <li class="has-dropdown">
                        <div class="submenu-title">
                            
                            <a href="#" class="submenu-toggle">
                                <i class="far fa-plus"></i>
                                <i class="far fa-minus"></i>
                            </a>

                            <?php saos_output_link($link); ?>
                            
                            <?php if(have_rows('dropdown')): ?>
                            <div class="dropdown">

                                <ul class="dropdownitems">
                                <?php while(have_rows('dropdown','options')) : the_row(); ?> 
                                    <li><?php saos_output_link(get_sub_field('dropdown_link')); ?></li>
                                <?php endwhile; ?>
                                </ul>

                            </div>
                            <?php endif; ?>
                            
                        </div>
                    </li>
                <?php else: ?>
                    <li><?php saos_output_link($link); ?></li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>
    </nav>
</div>
</header>
<main id="main">
