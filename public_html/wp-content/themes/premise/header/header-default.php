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

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content=""<?php bloginfo('name'); ?>"/>
    <meta name="msapplication-TileColor" content="#000000" />
    <meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/img/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="<?php bloginfo('template_directory'); ?>/img/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="<?php bloginfo('template_directory'); ?>/img/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="<?php bloginfo('template_directory'); ?>/img/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="<?php bloginfo('template_directory'); ?>/img/favicon/mstile-310x310.png" />


    <?php wp_head(); ?>
    
</head>

<body id="top-of-page" <?php body_class(); ?>>
    <header class="header cf">
        <nav class="secondary dropdown-container">
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
                                $phone = get_field('phone_number','options');
                                $phone_num = str_replace(array(' ','(',')','-','.','+'),'', $phone);

                                if($phone): ?>
                                    <li><a class="phone" href="tel:<?php echo $phone_num; ?>"><?php echo $phone; ?></a></li>
                                <?php endif; ?>

                                <?php if(have_rows('social_media', 'options')):
                                    while(have_rows('social_media', 'options')): the_row(); ?>
                                        <li>
                                            <a href="<?php the_sub_field('link'); ?>" target="_blank"><i class="fab <?php the_sub_field('icon'); ?>"></i></a>
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
                        <nav class="primary dropdown-container">
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
                if(get_sub_field('has_dropdown')): 
                ?>
                <li class="has-dropdown">
                    <?php saos_output_link($link); ?>

                    <span class="submenu-toggle">
                        <i class="far fa-plus"></i>
                    </span>

                    <?php if(have_rows('dropdown')): ?>
                    <div class="dropdown">
                        <ul class="dropdownitems">
                        <?php while(have_rows('dropdown','options')) : the_row(); ?>
                            <li><?php saos_output_link(get_sub_field('dropdown_link')); ?></li>
                        <?php endwhile; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
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
                
                if(get_sub_field('has_dropdown')): ?>
                    <li class="has-dropdown">
                        <?php saos_output_link($link); ?>

                        <span class="submenu-toggle">
                            <i class="far fa-plus"></i>
                        </span>
                        
                        <?php if(have_rows('dropdown')): ?>
                        <div class="dropdown">
                            <ul class="dropdownitems">
                            <?php while(have_rows('dropdown','options')) : the_row(); ?> 
                                <li><?php saos_output_link(get_sub_field('dropdown_link')); ?></li>
                            <?php endwhile; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
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
