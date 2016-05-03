<?php

function tph_register_shortcodes() {
	add_shortcode( 'tph-team-grid', 'tph_team_shortcode' );
	add_shortcode( 'team-card', 'tph_single_card_shortcode' );
}

add_action( 'init', 'tph_register_shortcodes' );

function tph_team_shortcode () {
	return tph_render_grid( 'tph_team' );
}



function tph_single_card_shortcode( $atts ) {

	$atts = shortcode_atts(array(
		'id' => 0
		), $atts);
	$team_member_id = $atts[ 'id' ];
	$return_string = '<div class="single-card">'; 
		if ( has_post_thumbnail() ) {
			$image_id = get_post_thumbnail_id( $team_member_id );
			$image_url = wp_get_attachment_image_src( $image_id,'square-image', true );
			$return_string .= '<img src=' . $image_url[0]. ' class="alignleft" >'; 				
			}
			
		$return_string .= '<h3>' . get_the_title( $team_member_id ) . '</h3>';
			// $id = get_the_ID();
		$return_string .= '<p><strong>' . get_post_meta( $team_member_id, 'occupation', true ) . '</strong></p>';
		$return_string .= '<p><em>' . get_post_meta( $team_member_id, 'home-town', true ) . '</em></p>';
/*		$return_string .= tph_render_icons( 'sport' , get_post( $team_member_id ) );	*/
		 $return_string .= '<div class="card-icons">' .  tph_render_icons( 'sport' , get_post( $team_member_id ) ) .  '</div>';
	$return_string .= '</div>';

	return $return_string;

}

