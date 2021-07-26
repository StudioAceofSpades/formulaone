<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="find-a-dealer" class="find-a-dealer">
    <div class="row no-gutters">
        <div class="col-sm-6">
            <!-- Header/Filter -->
            <input id="autocomplete" placeholder="Enter starting address, city, or zip code" type="text"></input>
            <!-- Results -->
        </div>
        <div class="col-sm-6">
            <div id="map"></div>
        </div>
    </div>
</div>

<script>
var geojson = {
	"type"		: 'FeatureCollection',
	"features"	: [
		<?php
		global $post;

		$args = array(
			'posts_per_page'	=> -1,
			'post_type'         => 'dealer',
		);
		$dealers = get_posts($args);
		foreach($dealers as $post) : 
			setup_postdata($post); 
			$lat    = get_field('latitude');
			$long   = get_field('longitude');
			?>
			{
				'type'      : 'Feature',
				'geometry'  : {
					'coordinates'   : [<?php echo $long; ?>,<?php echo $lat; ?>],
					'type'          : 'Point',
				},
				'property'  : {
					'title'         : '<?php the_title(); ?>',
					'marker-color'  : '#000000',
					'marker-size'   : 'large',
					'storeid'       : <?php echo $post->ID; ?>,
				}
			},
		<?php endforeach; wp_reset_postdata(); ?>
	],
};

</script>

<?php get_footer(); ?>
