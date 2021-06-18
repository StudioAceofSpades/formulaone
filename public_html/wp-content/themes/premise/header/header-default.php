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

<body id="top-of-page">

<header class="header cf">
    <nav class="secondary">
            <div class="row">
            <a href="<?php bloginfo('url'); ?>" class="brand">
                <img src="<?php bloginfo('template_directory'); ?>/img/Group 33.png" alt="<?php bloginfo('name'); ?>" class="formulaicon">
            </a>
                <div class="col d-flex justify-content-end">
                    <ul>
                        <li><a class="active" href="#home">Resources</a></li>
                        <li><a href="#news">Dealer Login</a></li>
                        <li><a href="#contact">About</a></li>
                        <li><a href="#about">Careers</a></li>
                    </ul>
                    <ul>
                    <li><a class="phone" href="tel:888-622-0828">888-622-0828</a></li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fab fa-facebook">Facebook</i>
                            </a>
                        </li><li>
                            <a href="#" target="_blank">
                                <i class="fab fa-youtube">YouTube</i>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fab fa-linkedin">LinkedIn</i>
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
    </nav>
<div class="main">
    <div class="row justify-content-between">
  
        <div class="col d-flex flex-grow-1 justify-content-end">
            <nav class="primary">
                    <ul>
                        <li><a class="active" href="#home">Cargo</a></li>
                        <li><a href="#news">Racing</a></li>
                        <li><a href="#contact">Commercial</a></li>
                        <li><a href="#about">Recreational</a></li>
                        <li><a href="#about">Contact</a></li>
                        <li><a class="button" href="#about">Build Yours</a></li>
                    </ul>
            </nav>
        </div>
    </div>
</div>
</header>

<main id="main">
