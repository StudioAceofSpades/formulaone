<section id="hero" class="hero">
	<?php if(is_front_page()): ?>
        <?php include(locate_template('parts/hero/hero-home.php')); ?>
		<?php else: ?>
        <?php include(locate_template('parts/hero/default.php')); ?>
	<?php endif; ?>
</section>
