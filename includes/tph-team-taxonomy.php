<?php


// Register Custom Taxonomy
function tph__team_taxonomy() {

	$labels = array(
		'name'                       => 'Sports',
		'singular_name'              => 'Sport',
		'menu_name'                  => 'Sports',
		'all_items'                  => 'All Sports',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Sport',
		'add_new_item'               => 'Add New Sport',
		'edit_item'                  => 'Edit Sport',
		'update_item'                => 'Update Sport`',
		'view_item'                  => 'View Sport',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove sports',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Sports',
		'search_items'               => 'Search Sports',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'sport', array( 'tph_team' ), $args );

}
add_action( 'init', 'tph__team_taxonomy', 0 );


function tph_add_terms() {
	$tax = 'sport';
	$terms = array(
		'crew' => array (
                'name'          => 'Crew',
                'slug'          => 'crew',
                            ),
		'cycle' => array (
                'name'          => 'Cycle',
                'slug'          => 'cycle',
                            ),
		'run' => array (
                'name'          => 'Run',
                'slug'          => 'run',
                            ),
		'swim' => array (
                'name'          => 'Swim',
                'slug'          => 'swim',
                            ),
		'Triathlon' => array (
                'name'          => 'Triathlon',
                'slug'          => 'Triathlon',
                            ),
		);

	foreach ( $terms as $term) {
		wp_insert_term(
			$term['name'],
			$tax,
			array( 'slug' => $term['slug'] )
			);
	}
	

}

add_action( 'init', 'tph_add_terms', 1);

