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
                        <?php if($image = get_field('logo_image','options')): ?>
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
                                    <li><?php saos_output_link($link); ?></li>
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
                                        $link = get_sub_field('main_menu_link'); 
                                        ?>
                                        <li><?php saos_output_link($link); ?></li>
                                    <?php endwhile; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </nav>

        </div>
    </header>

<main id="main">
