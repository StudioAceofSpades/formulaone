<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="options">

    <?php include(get_stylesheet_directory() . '/parts/hero.php'); ?>

    <div class="container">

        <?php if(have_rows('option_group')): ?>
        <div class="filter">
            <h3>Filter Options</h3>
            <form>
                <select id="option-filter">
                    <option value="all">Filter by Group</option>
                    <?php while(have_rows('option_group')): the_row(); ?>
                        <option value="<?php echo slugify(get_sub_field('group_name')); ?>"><?php the_sub_field('group_name'); ?></option>
                    <?php endwhile; ?>
                </select>
            </form>
        </div>
        <?php endif; ?>

        <?php if(have_rows('option_group')): ?>
        <div class="option-groups">
            <?php 
            $index = 0;
            while(have_rows('option_group')) : the_row(); ?>
            <div class="option-group" data-name="<?php echo slugify(get_sub_field('group_name')); ?>">
                <h3><?php the_sub_field('group_name'); ?></h3>
                <?php if(have_rows('options')): ?>
                <div class="row">
                    <?php 
                    $counter = 0;
                    while(have_rows('options')) : 
                        $counter++;
                        $index++;
                        the_row(); 
                        $image = get_sub_field('image');
                        ?>
                        
                        <div class="col-md-4">
                            <div 
                                class="option" 
                                data-index="<?php echo $index; ?>"
                                data-full="<?php echo $image['url']; ?>">

                                <?php if($image): ?>
                                <img src="<?php echo $image['sizes']['option']; ?>" alt="<?php echo $image['alt']; ?>">
                                <?php endif; ?>
                                <?php if($name = get_sub_field('name')): ?>
                                <h4><?php echo $name; ?></h4>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php 
                        if($counter % 3 == 0):
                            echo '</div><div class="row">';
                        endif;
                    endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        
    </div>
</div>

<div class="lightbox">
    <span class="lightbox-close"><i class="far fa-times"></i></span>
    
    <div class="lightbox-nav">
        <span class="lightbox-prev"><i class="far fa-angle-left"></i></span>
        <span class="lightbox-next"><i class="far fa-angle-right"></i></span>
    </div>
    
    <div class="lightbox-content">
        <img src="">
    </div>
</div>

<?php get_footer(); ?>
