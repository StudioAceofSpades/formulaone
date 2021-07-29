<?php
if (have_rows('images')): 
    $imageurl = array();
    while(have_rows('images') ): the_row();
        $image = get_sub_field('image');
        $imageurl[] = $image;
    endwhile;
endif;
?> 
<?php if (have_rows('images')): ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="gallery-page">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[0]; ?>);"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[1]; ?>);"></a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[2]; ?>);"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="main box-image" style="background-image:url(<?php echo $imageurl[3]; ?>);"></a>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[4]; ?>);"></a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[5]; ?>);"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="#" class="box-image" style="background-image:url(<?php echo $imageurl[6]; ?>);"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>