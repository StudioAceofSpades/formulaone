<section id="hero" class="hero">
	<?php if(is_front_page()): ?>
        <?php include(locate_template('parts/hero/home.php')); ?>
	<?php elseif(is_page_template('standardsubpage.php')): ?>
        <?php include(locate_template('parts/hero/hero-standardsubpage.php')); ?>
    <?php else: ?>
        <?php include(locate_template('parts/hero/hero-default.php')); ?>
	<?php endif; ?>
</section>