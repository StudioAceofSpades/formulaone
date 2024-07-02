<?php 
global $post;
$slug = $post->post_name;
?>
<div class="trailer-excerpt col-md-6 col-lg-3 d-flex flex-column">
    <?php if($image = get_field('trailer_image')): ?>
        <div class="image">
            <img src="<?php echo $image['sizes']['trailer-small']; ?>" alt="<?php echo $image['alt']; ?>">
        </div>
    <?php endif; ?>

    <?php if($title = get_field('page_title')): ?>
        <h3><?php echo $title; ?></h3>
    <?php endif; ?>

    <?php if($subtitle = get_field('page_subtitle')): ?>
        <h4><?php echo $subtitle; ?></h4>
    <?php endif; ?>

    <div class="buttons block">
        <a href="<?php the_permalink(); ?>" class="button orange-border">Learn More</a>
        <a href="<?php bloginfo('url'); ?>/enclosed-cargo-trailer-quote-request/" class="button orange">Request a Quote</a>
    </div>
</div>
