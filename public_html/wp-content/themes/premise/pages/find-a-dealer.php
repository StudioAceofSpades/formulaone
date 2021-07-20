<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="find-a-dealer">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-sm-6">
                <!-- Header/Filter -->
                <!-- Results -->
            </div>
            <div class="col-sm-6">
                <!-- Map -->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
