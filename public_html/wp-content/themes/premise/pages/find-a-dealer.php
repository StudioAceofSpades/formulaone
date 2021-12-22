<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="find-a-dealer" class="find-a-dealer">
    <div class="row no-gutters">
        <div class="col-lg-6 d-flex flex-column">
            <div class="map-info">
                <div class="map-controls">
                    <h1>Find a dealer</h1>
                    <form class="dealer-form">
                        <div class="row">
                            <div class="col-xs-6 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                <label>ZIP Code or Address</label>
                                <input
                                    value="<?php echo $_GET['zip']; ?>"
                                    id="autocomplete" 
                                    type="text">
                            </div>
                            <div class="col-xs-6 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                <label>Mile Search Radius</label>
                                <input 
                                    id="radius" 
                                    value="50" 
                                    min="5" 
                                    max="200" 
                                    step="1" 
                                    type="number">
                            </div>
                            <div class="col-lg-12 col-xl-4 d-flex align-items-end submit-wrapper">
                                <input
                                    id="submit"
                                    type="submit"
                                    value="Search">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="map-results desktop-results">
                    <h2>Dealer Results <span class="result-count"></span></h2>
                    <div class="found-results">
                        <div class="row">
                        </div>
                    </div>
                    <div class="row no-results error-message">
                        <div class="col">
                            <p>Unfortunately, no dealers match your search parameters. Please adjust them to find other results.</p>
                        </div>
                    </div>
                    <div class="row fill-fields error-message">
                        <div class="col">
                            <h3 class="error">Please fill out all fields before searching.</h3>
                        </div>
                    </div>
                    <div class="row no-search error-message">
                        <div class="col">
                            <p>Use the tool above to find dealers nearest you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 map-wrapper">
            <div id="map"></div>
            <div class="map-results mobile-results">
                <h2>Dealer Results <span class="result-count"></span></h2>
                <div class="found-results">
                    <div class="row">
                    </div>
                </div>
                <div class="row no-results error-message">
                    <div class="col">
                        <p>Unfortunately, no dealers match your search parameters. Please adjust them to find other results.</p>
                    </div>
                </div>
                <div class="row fill-fields error-message">
                    <div class="col">
                        <h3 class="error">Please fill out all fields before searching.</h3>
                    </div>
                </div>
                <div class="row no-search error-message">
                    <div class="col">
                        <p>Use the tool above to find dealers nearest you.</p>
                    </div>
                </div>
            </div>
            <div class="view-controls">
                <div class="buttons">
                    <a class="button map-view active" href="#">Map View</a>
                    <a class="button list-view" href="#">List View</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var geojson = {
    "type"      : 'FeatureCollection',
    "features"  : [
        <?php
            global $post;

        $args = array(
            'posts_per_page'	=> -1,
            'post_type'         => 'dealer',
        );
        $dealers = get_posts($args);
        foreach($dealers as $post) : 
            setup_postdata($post); 
            $lat        = get_field('latitude');
            $long       = get_field('longitude');
            $address    = htmlspecialchars(get_field('address'));

            if($address2 = htmlspecialchars(get_field('address_2'))) {
                $address .= '<br>'.$address2;
            }
            $address .= '<br>';
            $address .= get_field('city').', '.get_field('state') . ' ' .get_field('zip_code');

            $address = str_replace("\u0022","\\\\\"",json_encode($address,JSON_HEX_QUOT)); 

            if($lat && $long):
            ?>
            {
                'type'      : 'Feature',
                'geometry'  : {
                    'coordinates'   : [<?php echo $long; ?>,<?php echo $lat; ?>],
                    'type'          : 'Point',
                },
                'property'  : {
                    'title'         : '<?php the_title(); ?>',
                    'address'       : '<?php echo $address; ?>',
                    'phone'         : '<?php the_field('phone'); ?>',
                    'website'       : '<?php the_field('website'); ?>',
                    'marker-color'  : '#000000',
                    'marker-size'   : 'large',
                    'storeid'       : <?php echo $post->ID; ?>,
                    'lat'           : <?php the_field('latitude'); ?>,
                    'lng'           : <?php the_field('longitude'); ?>,
                }
            },
            <?php
            endif;
        endforeach; wp_reset_postdata(); ?>
    ],
};

</script>

<?php get_footer(); ?>
