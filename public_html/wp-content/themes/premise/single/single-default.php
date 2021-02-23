<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

	<article class="single-post">
    	
        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
        <div class="post-meta">
            <p>By <?php the_author(); ?> | Posted on <?php the_date(); ?> | <?php comments_number(); ?></p>
        </div>
        
    	<div class="post-content">
			<?php cfct_loop(); ?>
        </div>
        
    </article>
	
    <?php get_sidebar(); ?>

<?php get_footer(); ?>
