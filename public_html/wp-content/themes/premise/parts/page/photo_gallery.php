<!-- <?php
if (have_rows('images')): 
    while(have_rows('images') ): the_row();
        if(get_sub_field('image')):
            $image = get_sub_field('image');
            array_push($imageurl, $image['url']);
        endif;
    endwhile;
endif;
 ?> -->
<?php if (have_rows('images')): ?>
    <div class="row no-gutters">
        <?php while(have_rows('images') ): the_row(); ?>
            <div class="gallery-page">
                <div class="row">
                    <?php if($image = get_sub_field('image')): ?>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="box-image" style="background-image:url(<?php echo $image['url']; ?>);"></a>
                                    Image 1
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="box-image" style="background-image:url(<?php echo $image[1]; ?>);"></a>
                                    Image 2
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="box-image" style="background-image:url(<?php echo $image[2]; ?>);"></a>
                                    Image 3
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="box-image" style="background-image:url(<?php echo $image[3]; ?>);"></a>
                            middle Image
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#" class="box-image" style="background-image:url(<?php echo $image[4]; ?>);"></a>
                                    Image 5
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="box-image" style="background-image:url(<?php echo $image[5]; ?>);"></a>
                                    Image 6
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="box-image" style="background-image:url(<?php echo $image[6]; ?>);"></a>
                                    Image 7
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>