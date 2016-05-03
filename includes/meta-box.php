<?php
/* 
Create meta boxes for team-ph custom post type
*/

function tph_team_add_custom_post_metabox() {
	add_meta_box(
		'tph_team_post_metabox',
		'Athlete Information',
		'tph_team_display_post_metabox',
		'tph_team',
		'advanced',
		'high'
		);

}

add_action( 'add_meta_boxes', 'tph_team_add_custom_post_metabox' );


function tph_team_display_post_metabox( $post ) {

	$values = get_post_custom( $post->ID );
	$last_name = isset( $values[ 'last-name' ] ) ? $values[ 'last-name' ][ 0 ] : '';
	$home_town = isset( $values[ 'home-town' ] ) ? $values[ 'home-town' ][ 0 ] : '';
	$occupation = isset( $values[ 'occupation' ] ) ? $values[ 'occupation' ][ 0 ] : '';
	wp_nonce_field( 'tph-team-nonce', 'tph-team-nonce-field' );
	$html = '<label for="last_name"><strong>Last Name:</strong> </label><br>';
	$html .= '<input type="text" id="last-name" name="last-name" value="' . $last_name . ' " /><br>';
	$html .= '<label for="home-town"><strong>Home Town:</strong> </label><br>';
	$html .= '<input type="text" id="home-town" name="home-town" value="' . $home_town . ' " /><br>';
	$html .= '<label for="occupation"><strong>Occupation:</strong> </label><br>';
	$html .= '<input type="text" id="occupation" name="occupation" value="' . $occupation . ' " /><br>';
	
	
	echo $html;
	
	
    
    
}

function tph_team_save_meta_box_data( $post_id )  {
	
	
	


	if ( tph_team_user_can_save( $post_id, 'tph-team-nonce-field' ) ) {

		if ( isset( $_POST[ 'last-name' ] ) && 0 < count( strlen( trim( $_POST[ 'last-name' ] ) ) ) ) {
			$last_name = stripslashes( strip_tags( $_POST[ 'last-name' ] ) );
			update_post_meta( $post_id, 'last-name', $last_name );
		}
		if ( isset( $_POST[ 'home-town' ] ) && 0 < count( strlen( trim( $_POST[ 'home-town' ] ) ) ) ) {
			$home_town = stripslashes( strip_tags( $_POST[ 'home-town' ] ) );
			update_post_meta( $post_id, 'home-town', $home_town );
		}

		if ( isset( $_POST[ 'occupation' ] ) && 0 < count( strlen( trim( $_POST[ 'occupation' ] ) ) ) ) {
			$occupation = stripslashes( strip_tags( $_POST[ 'occupation' ] ) );
			update_post_meta( $post_id, 'occupation', $occupation );
		}
		
	}

}

add_action( 'save_post', 'tph_team_save_meta_box_data' );

function tph_team_user_can_save( $post_id, $nonce ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], 'tph-team-nonce' ) );
	
	return ! ( $is_autosave || $is_revision )  && $is_valid_nonce;

}


