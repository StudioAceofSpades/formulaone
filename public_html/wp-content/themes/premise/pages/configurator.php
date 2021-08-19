<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$trailer_slug   = $_GET['trailer'];
$trailer        = false;

if($trailer_slug) {
    $args           = array(
        'name'              => $trailer_slug,
        'post_type'         => 'trailer',
        'posts_per_page'    => 1,
    );
    $posts      = get_posts($args);
    $trailer    = array_pop($posts);
    $image      = get_field('');
}

get_header(); ?>

<section class="configurator <?php if($trailer) { ?>preload<?php } ?>">
    <div class="container">
        
        <div class="trailer-image">
            <?php if($trailer): ?>
            <img src="<?php bloginfo('url'); ?>/wp-content/uploads/2021/08/traverse-v-nose.png">
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-sm-6">
                
                <div class="tools">
                    <h1>Triumph Premium Cargo</h1>

                    <div class="buttons left switch-trailer">
                        <a class="button" href="#">
                            <span>Switch Trailer Model</span>
                            <i class="far fa-angle-right"></i>
                        </a>
                    </div>
        
                    <form class="form">
                        <div class="option">
                            <hgroup>
                                <h2>Trailer Size</h2>
                                <div class="buttons">
                                    <a class="button" href="#">
                                        <span>Trailer Size Specs</span>
                                    </a>
                                </div>
                            </hgroup>
                            <select data-name="size">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="2">3</option>
                            </select>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-sm-6">

                <div class="summary">
                    <h2>Your Trailer Summary</h2>
                    <div class="summary-item" data-name="trailer">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Trailer</h3>
                            </div>
                            <div class="col-sm-6">
                                <p>Triumph Premium Cargo</p>
                            </div>
                        </div>
                    </div>
                    <div class="summary-item" data-name="trailer">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Trailer Size</h3>
                            </div>
                            <div class="col-sm-6">
                                <p>Triumph Premium Cargo</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 offset-sm-6">
                            <div class="buttons">
                                <a class="button white-text" href="#">Save &amp; Share</a>
                                <a class="button orange" href="#">Get a Quote</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
