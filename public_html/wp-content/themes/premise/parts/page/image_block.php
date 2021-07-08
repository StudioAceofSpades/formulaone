<div class="image_block">
    <div class="container">
        <div class="row">
            <?php if (have_rows('images')): ?>
                <?php while(have_rows('images') ): the_row(); ?>
                <div class="col-wrapper">
                    <?php if(get_sub_field('image')): ?>
                        <?php $img = get_sub_field('image'); ?>
                        <img src="<?php echo $img ?>" alt="<?php the_sub_field('image_title'); ?>" class="img-fluid">
                    <?php endif; ?>
                    <?php if(get_sub_field('image_description')): ?>
                        <?php $desc = get_sub_field('image_description'); ?>
                        <div class="vl">
                            <div class="wysiwyg"><?php echo $desc ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
