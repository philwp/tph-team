<?php

class tph_team {
	
	function tph_team() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Team Members',
		    'singular_name' => 'Team Member',
		    'add_new' => 'Add New',
		    'all_items' => 'All Team Members',
		    'add_new_item' => 'Add New Profile',
		    'edit_item' => 'Edit Profile',
		    'new_item' => 'New Team Member',
		    'view_item' => 'View Team Member',
		    'search_items' => 'Search Posts',
		    'not_found' =>  'No Profiles found',
		    'not_found_in_trash' => 'No Profiles found in trash',
		    'parent_item_colon' => 'Parent Post:',
		    'menu_name' => 'Team Members'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Team PH athletes and crew",
			'taxonomies' => array('category'),
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_nav_menus' => true, 
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 20,
			'menu_icon' => null,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array('title','editor','thumbnail','excerpt','custom-fields'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'team-ph', 'with_front' => FALSE),
			'query_var' => true,
			'can_export' => true
		); 
		register_post_type('tph_team',$args);
	}
}

$tph_team = new tph_team();					