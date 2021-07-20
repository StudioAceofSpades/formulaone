<?php 
global $post;
$slug = $post->post_name;
?>
<div class="trailer-excerpt col-md-6 col-lg-3">
    <?php if($image = get_field('image')): ?>
    <div class="image">
        <img src="<?php echo $image['sizes']['trailer-small']; ?>" alt="<?php echo $image['alt']; ?>">
    </div>
    <?php endif; ?>

    <h3><?php the_title(); ?></h3>
    <?php if($subtitle = get_field('subtitle')): ?>
    <h4><?php echo $subtitle; ?></h4>
    <?php endif; ?>

    <div class="buttons block">
        <a href="<?php the_permalink(); ?>" class="button orange-border">Learn More</a>
        <a href="<?php bloginfo('url'); ?>/build-yours?trailer=<?php echo $slug; ?>" class="button orange">Build Yours</a>
    </div>
</div>
