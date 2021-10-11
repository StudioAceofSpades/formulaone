<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); } 
global $post;
?>

<article class="excerpt">
    
    <div class="card">
        <?php if($bg = get_the_post_thumbnail_url($post, 'excerpt')): ?>
        <img src="<?php echo $bg; ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>

        <h2 class="post-title"><?php the_title(); ?></h2>

        <div class="post-meta">
            <p>By <?php the_author(); ?> <span class="divider"></span> <?php the_date(); ?></p>
        </div>

        <a class="panel-link" href="<?php the_permalink(); ?>"></a>
    </div>

    <div class="post-content">
		<?php the_excerpt(); ?>
    </div>

    
</article>
