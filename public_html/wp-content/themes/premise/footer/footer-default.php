<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); } ?>

</main>

<footer class="footer">
    <div class="container">
        <div class="d-none d-md-block">
            <?php echo do_shortcode('[instagram-feed showheader=false showbutton=false showfollow=false num=4 cols=4]'); ?>
        </div>
        <div class="d-block d-md-none">
            <?php echo do_shortcode('[instagram-feed showheader=false showbutton=false showfollow=false num=2 cols=2]'); ?>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-3 footer-block">
                <?php if($icon = get_field('logo','options')): ?>
                <div class="img">
                    <img src="<?php echo $icon['url']; ?>" alt = "logo image">
                </div>
                <?php endif; ?>
            </div>
            <div class="newsletter col-md-4 col-lg-3 footer-block">
                <?php if($header = get_field('newsletter_header','options')): ?>
                    <h3><?php echo $header; ?></h3>
                <?php endif; ?>
                <div class="newsletter">
                    <?php echo do_shortcode(get_field('newsletter_script','options')); ?>
                </div> 
            </div>
            <div class="col-md-4 col-lg-3 footer-block">
                <?php if($header = get_field('site_map_header','options')) : ?>
                    <h3><?php echo $header; ?></h3>
                <?php endif; ?>
                <div class="cover">
                    <div class="site">
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
                    <div class="site">
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
            <div class="col-md-4 col-lg-3 footer-block">
                <div class="contact">
                    <?php include(locate_template('parts/contact-info.php')); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <?php if($link = get_field('privacy_policy_link','options')): ?>
                        <?php saos_output_link($link); ?>
                    <?php endif; ?>
                    <?php if($link = get_field('terms_&_conditions_link','options')): ?>
                        <?php saos_output_link($link); ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <p>&copy; <?php echo date('Y'); ?> Formula Trailers. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php the_field('scripts','options'); ?>

</body>
<?php wp_footer(); ?>
</html>
 
