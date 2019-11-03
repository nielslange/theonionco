<?php
/**
 * Monochrome Pro.
 *
 * This file adds the CPTs and CTAXs additions to the Monochrome Pro Theme.
 *
 * @package Monochrome
 * @author  Niels Lange
 * @license GPL-2.0-or-later
 */

/**
 * Register Custom Post Type
 *
 * @since 1.3.0
 * @return void
 */
function nl_generate_cpt() {

	$labels = array(
		'name'                  => _x( 'A.R.T. Charities', 'Post Type General Name', 'monochrome-pro' ),
		'singular_name'         => _x( 'A.R.T. Charity', 'Post Type Singular Name', 'monochrome-pro' ),
		'menu_name'             => __( 'A.R.T. Charities', 'monochrome-pro' ),
		'name_admin_bar'        => __( 'A.R.T. Charities', 'monochrome-pro' ),
		'archives'              => __( 'A.R.T. Charity Archives', 'monochrome-pro' ),
		'attributes'            => __( 'A.R.T. Charity Attributes', 'monochrome-pro' ),
		'parent_item_colon'     => __( 'Parent Item:', 'monochrome-pro' ),
		'all_items'             => __( 'All A.R.T. Charity', 'monochrome-pro' ),
		'add_new_item'          => __( 'Add New A.R.T. Charity', 'monochrome-pro' ),
		'add_new'               => __( 'Add New', 'monochrome-pro' ),
		'new_item'              => __( 'New A.R.T. Charity', 'monochrome-pro' ),
		'edit_item'             => __( 'Edit A.R.T. Charity', 'monochrome-pro' ),
		'update_item'           => __( 'Update A.R.T. Charity', 'monochrome-pro' ),
		'view_item'             => __( 'View A.R.T. Charity', 'monochrome-pro' ),
		'view_items'            => __( 'View A.R.T. Charity', 'monochrome-pro' ),
		'search_items'          => __( 'Search A.R.T. Charity', 'monochrome-pro' ),
		'not_found'             => __( 'Not found', 'monochrome-pro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'monochrome-pro' ),
		'featured_image'        => __( 'Featured Image', 'monochrome-pro' ),
		'set_featured_image'    => __( 'Set featured image', 'monochrome-pro' ),
		'remove_featured_image' => __( 'Remove featured image', 'monochrome-pro' ),
		'use_featured_image'    => __( 'Use as featured image', 'monochrome-pro' ),
		'insert_into_item'      => __( 'Insert into A.R.T. Charity', 'monochrome-pro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this A.R.T. Charity', 'monochrome-pro' ),
		'items_list'            => __( 'A.R.T. Charities list', 'monochrome-pro' ),
		'items_list_navigation' => __( 'A.R.T. Charities list navigation', 'monochrome-pro' ),
		'filter_items_list'     => __( 'Filter A.R.T. Charities list', 'monochrome-pro' ),
	);
	$args   = array(
		'label'               => __( 'A.R.T. Charity', 'monochrome-pro' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'author' ),
		'taxonomies'          => array( 'artc_category', 'artc_post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-heart',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
	);
	register_post_type( 'art-charity', $args );

	$labels = array(
		'name'                  => _x( 'Tribe Members', 'Post Type General Name', 'monochrome-pro' ),
		'singular_name'         => _x( 'Tribe Member', 'Post Type Singular Name', 'monochrome-pro' ),
		'menu_name'             => __( 'Tribe Members', 'monochrome-pro' ),
		'name_admin_bar'        => __( 'Tribe Members', 'monochrome-pro' ),
		'archives'              => __( 'Tribe Member Archives', 'monochrome-pro' ),
		'attributes'            => __( 'Tribe Member Attributes', 'monochrome-pro' ),
		'parent_item_colon'     => __( 'Parent Tribe Member:', 'monochrome-pro' ),
		'all_items'             => __( 'All Tribe Members', 'monochrome-pro' ),
		'add_new_item'          => __( 'Add New Tribe Member', 'monochrome-pro' ),
		'add_new'               => __( 'Add New', 'monochrome-pro' ),
		'new_item'              => __( 'New Tribe Member', 'monochrome-pro' ),
		'edit_item'             => __( 'Edit Tribe Member', 'monochrome-pro' ),
		'update_item'           => __( 'Update Tribe Member', 'monochrome-pro' ),
		'view_item'             => __( 'View Tribe Member', 'monochrome-pro' ),
		'view_items'            => __( 'View Tribe Members', 'monochrome-pro' ),
		'search_items'          => __( 'Search Tribe Member', 'monochrome-pro' ),
		'not_found'             => __( 'Not found', 'monochrome-pro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'monochrome-pro' ),
		'featured_image'        => __( 'Featured Image', 'monochrome-pro' ),
		'set_featured_image'    => __( 'Set featured image', 'monochrome-pro' ),
		'remove_featured_image' => __( 'Remove featured image', 'monochrome-pro' ),
		'use_featured_image'    => __( 'Use as featured image', 'monochrome-pro' ),
		'insert_into_item'      => __( 'Insert into Tribe Member', 'monochrome-pro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Tribe Member', 'monochrome-pro' ),
		'items_list'            => __( 'Tribe Members list', 'monochrome-pro' ),
		'items_list_navigation' => __( 'Tribe Members list navigation', 'monochrome-pro' ),
		'filter_items_list'     => __( 'Filter Tribe Members list', 'monochrome-pro' ),
	);
	$args   = array(
		'label'               => __( 'Tribe Member', 'monochrome-pro' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'author' ),
		'taxonomies'          => array( 'tm_category', 'tm_post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
	);
	register_post_type( 'tribe-member', $args );

}
add_action( 'init', 'nl_generate_cpt', 0 );

/**
 * Register Custom Taxonomy
 *
 * @since 1.3.0
 * @return void
 */
function nl_generate_ctax() {

	$labels = array(
		'name'                       => _x( 'A.R.T. Charity Categories', 'Category General Name', 'monochrome-pro' ),
		'singular_name'              => _x( 'Category', 'Category Singular Name', 'monochrome-pro' ),
		'menu_name'                  => __( 'Category', 'monochrome-pro' ),
		'all_items'                  => __( 'All Categories', 'monochrome-pro' ),
		'parent_item'                => __( 'Parent Category', 'monochrome-pro' ),
		'parent_item_colon'          => __( 'Parent Category:', 'monochrome-pro' ),
		'new_item_name'              => __( 'New Category Name', 'monochrome-pro' ),
		'add_new_item'               => __( 'Add New Category', 'monochrome-pro' ),
		'edit_item'                  => __( 'Edit Category', 'monochrome-pro' ),
		'update_item'                => __( 'Update Category', 'monochrome-pro' ),
		'view_item'                  => __( 'View Category', 'monochrome-pro' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'monochrome-pro' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'monochrome-pro' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'monochrome-pro' ),
		'popular_items'              => __( 'Popular Categories', 'monochrome-pro' ),
		'search_items'               => __( 'Search Categories', 'monochrome-pro' ),
		'not_found'                  => __( 'Not Found', 'monochrome-pro' ),
		'no_terms'                   => __( 'No categories', 'monochrome-pro' ),
		'items_list'                 => __( 'Categories list', 'monochrome-pro' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'monochrome-pro' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'artc_category', array( 'art-charity' ), $args );

	$labels = array(
		'name'                       => _x( 'A.R.T. Charity Tags', 'Tribe Member Tag General Name', 'monochrome-pro' ),
		'singular_name'              => _x( 'Tag', 'Tribe Member Tag Singular Name', 'monochrome-pro' ),
		'menu_name'                  => __( 'Tag', 'monochrome-pro' ),
		'all_items'                  => __( 'All Tags', 'monochrome-pro' ),
		'parent_item'                => __( 'Parent Tag', 'monochrome-pro' ),
		'parent_item_colon'          => __( 'Parent Tag:', 'monochrome-pro' ),
		'new_item_name'              => __( 'New Tag Name', 'monochrome-pro' ),
		'add_new_item'               => __( 'Add New Tag', 'monochrome-pro' ),
		'edit_item'                  => __( 'Edit Tag', 'monochrome-pro' ),
		'update_item'                => __( 'Update Tag', 'monochrome-pro' ),
		'view_item'                  => __( 'View Tag', 'monochrome-pro' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'monochrome-pro' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'monochrome-pro' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'monochrome-pro' ),
		'popular_items'              => __( 'Popular Tags', 'monochrome-pro' ),
		'search_items'               => __( 'Search Tags', 'monochrome-pro' ),
		'not_found'                  => __( 'Not Found', 'monochrome-pro' ),
		'no_terms'                   => __( 'No tags', 'monochrome-pro' ),
		'items_list'                 => __( 'Tags list', 'monochrome-pro' ),
		'items_list_navigation'      => __( 'Tags list navigation', 'monochrome-pro' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'artc_post_tag', array( 'art-charity' ), $args );

	$labels = array(
		'name'                       => _x( 'Tribe Member Categories', 'Category General Name', 'monochrome-pro' ),
		'singular_name'              => _x( 'Category', 'Category Singular Name', 'monochrome-pro' ),
		'menu_name'                  => __( 'Category', 'monochrome-pro' ),
		'all_items'                  => __( 'All Categories', 'monochrome-pro' ),
		'parent_item'                => __( 'Parent Category', 'monochrome-pro' ),
		'parent_item_colon'          => __( 'Parent Category:', 'monochrome-pro' ),
		'new_item_name'              => __( 'New Category Name', 'monochrome-pro' ),
		'add_new_item'               => __( 'Add New Category', 'monochrome-pro' ),
		'edit_item'                  => __( 'Edit Category', 'monochrome-pro' ),
		'update_item'                => __( 'Update Category', 'monochrome-pro' ),
		'view_item'                  => __( 'View Category', 'monochrome-pro' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'monochrome-pro' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'monochrome-pro' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'monochrome-pro' ),
		'popular_items'              => __( 'Popular Categories', 'monochrome-pro' ),
		'search_items'               => __( 'Search Categories', 'monochrome-pro' ),
		'not_found'                  => __( 'Not Found', 'monochrome-pro' ),
		'no_terms'                   => __( 'No categories', 'monochrome-pro' ),
		'items_list'                 => __( 'Categories list', 'monochrome-pro' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'monochrome-pro' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
		'menu_position'     => 1,

	);
	register_taxonomy( 'tm_category', array( 'tribe-member' ), $args );

	$labels = array(
		'name'                       => _x( 'Tribe Member Tags', 'Tribe Member Tag General Name', 'monochrome-pro' ),
		'singular_name'              => _x( 'Tag', 'Tribe Member Tag Singular Name', 'monochrome-pro' ),
		'menu_name'                  => __( 'Tag', 'monochrome-pro' ),
		'all_items'                  => __( 'All Tags', 'monochrome-pro' ),
		'parent_item'                => __( 'Parent Tag', 'monochrome-pro' ),
		'parent_item_colon'          => __( 'Parent Tag:', 'monochrome-pro' ),
		'new_item_name'              => __( 'New Tag Name', 'monochrome-pro' ),
		'add_new_item'               => __( 'Add New Tag', 'monochrome-pro' ),
		'edit_item'                  => __( 'Edit Tag', 'monochrome-pro' ),
		'update_item'                => __( 'Update Tag', 'monochrome-pro' ),
		'view_item'                  => __( 'View Tag', 'monochrome-pro' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'monochrome-pro' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'monochrome-pro' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'monochrome-pro' ),
		'popular_items'              => __( 'Popular Tags', 'monochrome-pro' ),
		'search_items'               => __( 'Search Tags', 'monochrome-pro' ),
		'not_found'                  => __( 'Not Found', 'monochrome-pro' ),
		'no_terms'                   => __( 'No tags', 'monochrome-pro' ),
		'items_list'                 => __( 'Tags list', 'monochrome-pro' ),
		'items_list_navigation'      => __( 'Tags list navigation', 'monochrome-pro' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'tm_post_tag', array( 'tribe-member' ), $args );

}
add_action( 'init', 'nl_generate_ctax', 0 );
