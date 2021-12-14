<div class="trailer-select">
    <div class="lifestyle-select">
        <div class="row no-gutters justify-content-center">
            <div class="col-sm-6">
                <div class="lifestyle-button" style="background-image: url(<?php the_field('cargo_background_image'); ?>);" data-panel="cargo">
                    <h3>Cargo</h3>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="lifestyle-button" style="background-image: url(<?php the_field('racing_background_image'); ?>);" data-panel="racing">
                    <h3>Racing</h3>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="lifestyle-button" style="background-image: url(<?php the_field('commercial_background_image'); ?>);" data-panel="commercial">
                    <h3>Commercial</h3>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="lifestyle-button" style="background-image: url(<?php the_field('recreational_background_image'); ?>);" data-panel="recreational">
                    <h3>Recreational</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-cargo">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                $cargo = get_field('cargo');
                if( $cargo ):
                    $i = 0;
                    foreach( $cargo as $post ):
                        $i++;
                        setup_postdata($post);
                        ?>
                        <div class="col-sm-3 col-6 d-flex">
                            <?php
                            $trailer_image = get_field('base_image');
                            $slug = $post->post_name;
                            ?>
                            <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <div class="close-trailer-select d-flex align-items-center justify-content-center">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <div class="panel panel-racing">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                $racing = get_field('racing');
                if( $racing ):
                    $i = 0;
                    foreach( $racing as $post ):
                        $i++;
                        setup_postdata($post);
                        ?>
                        <div class="col-sm-4 col-6 d-flex">
                            <?php
                            $trailer_image = get_field('base_image');
                            $slug = $post->post_name;
                            ?>
                            <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <div class="close-trailer-select d-flex align-items-center justify-content-center">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <div class="panel panel-commercial">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                $commercial = get_field('commercial');
                if( $commercial ):
                    $i = 0;
                    foreach( $commercial as $post ):
                        $i++;
                        setup_postdata($post);
                        ?>
                        <div class="col-sm-4 col-6 d-flex">
                            <?php
                            $trailer_image = get_field('base_image');
                            $slug = $post->post_name;
                            ?>
                            <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <div class="close-trailer-select d-flex align-items-center justify-content-center">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <div class="panel panel-recreational">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                $recreational = get_field('recreational');
                if( $recreational ):
                    $i = 0;
                    foreach( $recreational as $post ):
                        $i++;
                        setup_postdata($post);
                        ?>
                        <div class="col-sm-4 col-6 d-flex">
                            <?php
                            $trailer_image = get_field('base_image');
                            $slug = $post->post_name;
                            ?>
                            <a href="<?php bloginfo('url'); ?>/build-yours/?model=<?php echo $slug; ?>" class="d-flex flex-column justify-content-end">
                                <img src="<?php echo $trailer_image['url']; ?>" alt="<?php the_field('page_title'); ?>" class="img-fluid">
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <div class="close-trailer-select d-flex align-items-center justify-content-center">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
</div>
