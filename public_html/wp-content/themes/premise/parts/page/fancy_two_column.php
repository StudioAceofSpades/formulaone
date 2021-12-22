<div class="fancy-cols">
    <?php if (have_rows('fancy_two_col')): ?>
        <?php while(have_rows('fancy_two_col') ): the_row(); ?>
        <div class="bg-orange">
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <?php if(get_sub_field('header')): ?>
                            <?php $header = get_sub_field('header'); ?>
                            <h1><?php echo $header ?></h1>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="content bg-gray">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 secondary">
                        <div class="header_card">
                            <?php if(get_sub_field('block_left')): ?>
                                <?php $block_left = get_sub_field('block_left'); ?>
                                    <?php echo $block_left ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 secondary">
                        <div class="header_card">
                            <?php if(get_sub_field('block_right')): ?>
                                <?php $block_right = get_sub_field('block_right'); ?>
                                    <?php echo $block_right ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
