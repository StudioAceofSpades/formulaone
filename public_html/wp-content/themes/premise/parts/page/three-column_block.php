<div class="basic-cols">
    <div class="container">
        <div class="row">
            <?php if (have_rows('three_column')): ?>
                <?php while(have_rows('three_column') ): the_row(); ?>
                    <div class="col-md-4<?php echo get_sub_field('center_paragraph') ? ' text-center' : '' ?>">
                        <div class="col-wrapper">
                            <?php if(get_sub_field('image')): ?>
                                <?php $img = get_sub_field('image'); ?>
                                <img src="<?php echo $img ?>" alt="<?php the_sub_field('title'); ?>" class="img-fluid">
                            <?php endif; ?>
                            <?php if(get_sub_field('title')): ?>
                                <?php $title = get_sub_field('title'); ?>
                                <h3 class="title"><?php echo $title ?></h3>
                            <?php endif; ?>
                            <?php if(get_sub_field('sub_header')): ?>
                                <?php $subheader = get_sub_field('sub_header'); ?>
                                <h4 class="subheader"><?php echo $subheader ?></h4>
                            <?php endif; ?>
                            <?php if(get_sub_field('description')): ?>
                                <?php $desc = get_sub_field('description'); ?>
                                <div class="wysiwyg"><?php echo $desc ?></div>
                            <?php endif; ?>
                            <?php if(get_sub_field('column_button')): ?>
                                <?php $btn = get_sub_field('column_button'); ?>
                                <?php $alignment = get_sub_field('column_button_alignment'); ?>
                                <div class="buttons <?php echo $alignment; ?>">
                                    <a href="<?php echo $btn['url'];?>" class="button white" target="<?php echo $btn['target'];?>"><?php echo $btn['title']; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
