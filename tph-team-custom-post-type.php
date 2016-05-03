<?php

/*
Plugin Name: Racing Team
Description: Custom Post Type for Team PH Team.  Use [tph-team-grid] shortcode to display on a page.
Version: 1.5.0
Author: Fort Pitt Web Shop, Phil Webster
*/

/*
CONSTANTS
*/

// plugin folder url
if(!defined('TPH_PLUGIN_URL')) {
	define('TPH_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
// plugin folder path
if(!defined('TPH_PLUGIN_DIR')) {
	define('TPH_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
}
// plugin root file
if(!defined('TPH_PLUGIN_FILE')) {
	define('TPH_PLUGIN_FILE', __FILE__);
}

/*
File Includes
*/
include_once( TPH_PLUGIN_DIR . '/includes/post-type.php' );
include_once( TPH_PLUGIN_DIR . '/includes/meta-box.php' );
include_once( TPH_PLUGIN_DIR . '/includes/tph-team-taxonomy.php' );
include_once( TPH_PLUGIN_DIR . '/includes/shortcode.php' );



				


function tph_render_icons($name_of_taxonomy, $post=NULL ) {

	$terms = get_the_terms( $post->ID, $name_of_taxonomy );
	$html = '';						
	if ( $terms && ! is_wp_error( $terms ) ) {

		$sports =  array( 	'run' => '<img src="https://maxcdn.icons8.com/Android_L/PNG/48/Sports/running-48.png" alt="Running" title="Running" width="48">',
							'cycle' => '<img src="https://maxcdn.icons8.com/Android_L/PNG/48/Sports/time_trial_biking-48.png" title="Cycling" alt="Cycling" width="48">',
							'crew'=> '<img src="https://maxcdn.icons8.com/Android_L/PNG/48/Transport/bus2-48.png" alt="Crew" title="Crew" width="48">',														
							'swim' => '<img src="https://maxcdn.icons8.com/Android_L/PNG/48/Sports/swimming-48.png" alt="Swimming" title="Swimming" width="48">',
							'triathlon' => '<img src="'. TPH_PLUGIN_URL . '/img/tri.png" alt="Triathlon" title="Triathlon" width="48">'					
					);
		
		
		foreach ( $terms as $term ) {
			$html .= $sports[$term->slug];
		
		}
	}
	return $html;	
}

function tph_render_grid( $post_type ) {
	
		$args = array(
					'post_type' => $post_type , 
					'posts_per_page' => -1,					
					'meta_key' => 'last-name',
					'meta_type' => 'CHAR',
					'orderby'  => 'meta_value',
					'order' => 'ASC'
					);
		$query = new WP_Query($args);
		$html = '';
		if ( $query->have_posts() ) {
			$html .= '<div class="page-header">';	
				$html .= '<header class="entry-header">';					
					the_archive_description( '<h1 class="page-title">', '</h1>' );				
				$html .= '</header>';
				$html .= '</div>';
		
				$html .= '<section>'; 
					$html .= '<ul class="team grid">';
				 while ( $query->have_posts() ) : 
				 	$query->the_post();

						$html.= '<li class="card half"><a href=" ' . get_permalink() . ' ">';


						if ( has_post_thumbnail() ) {
							$image_id = get_post_thumbnail_id();
							$image_url = wp_get_attachment_image_src($image_id,'square-image', true );
							$html.= '<img src=' . $image_url[0]. ' class="alignleft" >';  
							}

							$html.= '<h3>' . get_the_title() . '</h3>';
							$html.= '</a>';
							$id = get_the_ID();
							$html.= '<p>' . get_post_meta( $id, 'home-town', true ) . '</p>';							
							$html .= '<div class="card-icons">' . tph_render_icons('sport') . '</div>';														

						endwhile; 
				 wp_reset_postdata();

					}

							$html.= '</li>';
					$html.= '</ul>';
				$html.= '</section>';

				return $html;

	}