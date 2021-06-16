<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); } if (CFCT_DEBUG) { cfct_banner(__FILE__); } ?>

<footer class="footer d-flex flex-column align-items-center">

    <a href="<?php bloginfo('url'); ?>" class="brand">
        <img src="<?php bloginfo('template_directory'); ?>/img/dynamicscon-logo-white.svg">
    </a>

    <?php if(have_rows('links','options')): ?>
        <nav class="footer-nav">
            <ul>
            <?php while(have_rows('links','options')): the_row(); ?>
                <?php if($link = get_sub_field('link')): ?>
                <li>
                    <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
                </li>
                <?php endif; ?>
            <?php endwhile; ?>
            </ul>
        </nav>
    <?php endif; ?>

    <a href="<?php bloginfo('url'); ?>/terms-and-privacy-policy" class="terms">Terms &amp; Privacy Policy</a>
    <a href="<?php bloginfo('url'); ?>/logout" class="logout">Logout</a>
    
    <div class="social">
        <?php if($f = get_field('facebook','options')): ?>
        <a href="<?php echo $f; ?>" target="_blank"><i class="fab fa-facebook-square"></i></a>
        <?php endif; ?>
        <?php if($t = get_field('twitter','options')): ?>
        <a href="<?php echo $t; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
        <?php endif; ?>
        <?php if($l = get_field('linkedin','options')): ?>
        <a href="<?php echo $l; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
        <?php endif; ?>
    </div>
    
    <h2 class="archive">ARCHIVE</h2>

    <div class="sec">
        <?php if($link = get_field('session_link','options')): ?>
        <a href="<?php echo $link['url']; ?>" class="terms"><?php echo $link['title']; ?></a>
        <?php endif; ?>
        
        <?php if($link =get_field('keynote_link','options')): ?>
        <a href="<?php echo $link['url']; ?>" class="terms"><?php echo $link['title']; ?></a>
        <?php endif; ?>
    </div>

    <?php if(have_rows('secondary_links','options')): ?>
        <div class="secondary">
            <nav class="footer-nav">
                <ul>
                <?php while(have_rows('secondary_links','options')): the_row(); ?>
                    <?php if($link = get_sub_field('link')): ?>
                    <li>
                        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>
                    </li>
                    <?php endif; ?>
                <?php endwhile; ?>
                </ul>
            </nav>
        </div>
    <?php endif; ?>


</footer>

<a class="top" href="#top-of-page">Back to top<i class="far fa-level-up"></i></a>

<div class="register-modal modal" id="register-modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Just a second!</h2>
        </div>
        <div class="modal-copy">
            <p>In order to vote for your favorite submissions on our site, <strong>you need to register.</strong> This helps us ensure that every vote counts, including yours!</p>
        </div>
        <div class="modal-buttons">
            <div class="buttons">
                <a class="button green enter-email" href="#">Already did!</a>
                <a class="button light-blue" href="<?php bloginfo('url'); ?>/register">I need to register!</a>
            </div>
        </div>
    </div>
</div>

<div class="login-modal modal" id="login-modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Let's Login!</h2>
        </div>
        <div class="modal-copy">
            <p>Enter your email address so we can verify your registration.</p>
            <div class="form">
                <input type="text" placeholder="you@youremail.com" id="login-email">
                <div class="errors">
                    <div data-error="no-email">You must enter your email.</div>
                    <div data-error="not-found">Your email has not been found. Try again or register.</div>
                </div>
            </div>
            <div class="success">
                <p>Hooray! You'll be redirected momentarily.</p>
            </div>
        </div>
        <div class="modal-buttons">
            <div class="buttons">
                <a class="button simple" href="#close">Cancel</a>
                <a 
                    class="button light-blue verify-login" 
                    data-check="false"
                    data-redirect="<?php bloginfo('url'); ?>">Login</a>
            </div>
        </div>
    </div>
</div>

<div class="login-modal modal" id="check-modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Already in our system from a previous DynamicsCon?</h2>
        </div>
        <div class="modal-copy">
            <p>Enter your email address so we can verify your registration.</p>
            <div class="form">
                <input type="text" placeholder="you@youremail.com" class="login-email">
            </div>
            <div class="errors"></div>
            <div class="success"></div>
        </div>
        <div class="modal-buttons">
            <div class="buttons">
                <a class="button simple" href="#close">Cancel</a>
                <a 
                    class="button light-blue verify-login" 
                    data-check="false"
                    data-redirect="<?php bloginfo('url'); ?>/submissions/"
                    data-fail-redirect="<?php bloginfo('url'); ?>/register/"
                    href="#">Verify!</a>
            </div>
        </div>
    </div>
</div>

</body>

<?php wp_footer(); ?>
</html>
