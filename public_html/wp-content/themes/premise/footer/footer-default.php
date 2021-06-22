<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); } ?>

</main>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-grow-1 justify-content-end">
                <div class="col-md-6 col-lg-3">
                    <?php if($icon = get_field('logo','options')): ?>
                    <div class = "img">
                        <img src="<?php echo $icon['url']; ?>" alt = "logo image">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php if($header = get_field('newsletter_header','options')): ?>
                    <div class="title"><?php echo $header; ?></div>
                    <?php endif; ?>
                    <div class="newsletter">
                        <?php the_field('newsletter_script','options'); ?>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php if($header = get_field('site_map_header','options')) : ?>
                    <div class="title"><?php echo $header; ?></div>
                    <?php endif; ?>
                    <div class="cover">
                        <div class="site1">
                            <?php if( have_rows('site_map_links_left','options') ): ?>
                                <ul>
                                <?php while (have_rows('site_map_links_left','options')) : the_row(); ?>
                                    <?php if($link = get_sub_field('links')): ?>
                                        <li>
                                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="site2">
                            <?php if( have_rows('site_map_links_right','options') ): ?>
                                <ul>
                                <?php while (have_rows('site_map_links_right','options')) : the_row(); ?>
                                    <?php if($link = get_sub_field('links_right')): ?>
                                        <li>
                                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <?php if($header = get_field('contact_header','options')): ?>
                    <div class="title"><?php echo $header; ?></div>
                    <?php endif; ?>
                    <div class="contact">
                        <?php the_field('contact_info','options'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php if($link = get_field('privacy_policy_link','options')): ?>
                        <?php saos_output_link($link); ?>
                    <?php endif; ?>
                    <?php if($link = get_field('terms_&_conditions_link','options')): ?>
                        <?php saos_output_link($link); ?>
                    <?php endif; ?>
                </div>
                <div class="endstack">
                    <div class="d-none d-sm-inline">&copy; <?php echo date('Y'); ?> 2021 Formula Trailers. All Rights Reserved. </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php the_field('scripts','options'); ?>

</body>
<?php wp_footer(); ?>
</html>
 