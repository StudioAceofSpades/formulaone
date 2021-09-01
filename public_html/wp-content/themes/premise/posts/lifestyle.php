<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); } 

global $post;

$tax        =	$wp_query->queried_object;
$trailers   = get_posts(array(
    'posts_per_page'    => -1,
    'post_type'         => 'trailer',
    'tax_query'         => array(
        array(
            'taxonomy'  => 'lifestyle',
            'field'     => 'term_id',
            'terms'     => $tax->term_id,
        )
    )
));
?>

<div id="lifestyle" class="single-lifestyle">

    <?php include(get_stylesheet_directory() . "/parts/hero.php"); ?>

    <?php if($trailers): ?>
        <div class="container">
            <div class="row justify-content-center">
                <?php 
                $counter = 0;
                foreach($trailers as $post):
                    $counter++;
                    setup_postdata($post);
                    include(get_stylesheet_directory() . "/excerpt/type-trailer.php");
                    if($counter % 4 == 0) {
                        echo '</div><div class="row justify-content-center">';
                    }
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    <?php endif; ?>

</div>
