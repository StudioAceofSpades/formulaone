<?php if(get_sub_field('sizing') == 'wide'): ?>
<div class="wysiwyg wide">
<?php else: ?>
<div class="wysiwyg">
<?php endif; ?>
    <div class="container">
        <?php the_sub_field('wysiwyg'); ?>
    </div>
</div>
