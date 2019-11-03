<?php
/**
 * Monochrome Pro.
 *
 * This file adds functions to the Monochrome Pro Theme.
 *
 * @package Monochrome
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/monochrome/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Setup Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'monochrome_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function monochrome_localization_setup() {

	load_child_theme_textdomain( 'monochrome-pro', get_stylesheet_directory() . '/languages' );

}

// Adds the theme helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds Image upload and Color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Includes the Customizer CSS for the WooCommerce plugin.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Includes notice to install Genesis Connect for WooCommerce.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// Includes CPTs and CTAXs.
require_once get_stylesheet_directory() . '/lib/cpt-and-ctax.php';

add_action( 'after_setup_theme', 'monochrome_theme_support', 1 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 1.3.0
 */
function monochrome_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * Allows plugins to Removes support if required.
 *
 * @since 1.1.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'monochrome_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function monochrome_enqueue_scripts_styles() {

	wp_enqueue_style( 'monochrome-fonts', '//fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i|Open+Sans+Condensed:300', [], genesis_get_theme_version() );
	wp_enqueue_style( 'monochrome-ionicons', '//unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css', [], genesis_get_theme_version() );

	wp_enqueue_script( 'monochrome-global-script', get_stylesheet_directory_uri() . '/js/global.js', [ 'jquery' ], '1.0.0', true );
	wp_enqueue_script( 'monochrome-block-effects', get_stylesheet_directory_uri() . '/js/block-effects.js', [], '1.0.0', true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'monochrome-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', [ 'jquery' ], genesis_get_theme_version(), true );
	wp_localize_script( 'monochrome-responsive-menu', 'genesis_responsive_menu', monochrome_responsive_menu_settings() );

}

add_action( 'admin_enqueue_scripts', 'admin_style' );
/**
 * Enqueues admin styles.
 *
 * @since 1.3.0
 */
function admin_style() {
	wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri() . '/admin.css', array(), wp_get_theme()->get( 'Version' ), 'screen' );
}

/**
 * Defines responsive menu settings.
 *
 * @since 1.1.0
 */
function monochrome_responsive_menu_settings() {

	$settings = [
		'mainMenu'         => __( 'Menu', 'monochrome-pro' ),
		'menuIconClass'    => 'ionicons-before ion-ios-menu',
		'subMenu'          => __( 'Submenu', 'monochrome-pro' ),
		'subMenuIconClass' => 'ionicons-before ion-ios-arrow-down',
		'menuClasses'      => [
			'combine' => [],
			'others'  => [
				'.nav-primary',
			],
		],
	];

	return $settings;

}

// Adds image sizes.
add_image_size( 'featured-blog', 600, 338, true );
add_image_size( 'sidebar-thumbnail', 80, 80, true );

add_filter( 'image_size_names_choose', 'monochrome_media_library_sizes' );
/**
 * Adds featured-blog image size to Media Library.
 *
 * @since 1.0.0
 *
 * @param array $sizes Array of image sizes and their names.
 * @return array The modified list of sizes.
 */
function monochrome_media_library_sizes( $sizes ) {

	$sizes['featured-blog'] = __( 'Featured Blog - 600px by 338px', 'monochrome-pro' );

	return $sizes;

}

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after', 'genesis_do_subnav', 12 );

add_action( 'genesis_meta', 'monochrome_add_search_icon' );
/**
 * Adds the search icon to the header if the option is set in the Customizer.
 *
 * @since 1.0.0
 */
function monochrome_add_search_icon() {

	$show_icon = get_theme_mod( 'monochrome_header_search', monochrome_customizer_get_default_search_setting() );

	// Exit early if option set to false.
	if ( ! $show_icon ) {
		return;
	}

	add_action( 'genesis_header', 'monochrome_do_header_search_form', 14 );
	add_filter( 'genesis_nav_items', 'monochrome_add_search_menu_item', 10, 2 );
	add_filter( 'wp_nav_menu_items', 'monochrome_add_search_menu_item', 10, 2 );

}

/**
 * Modifies the menu item output of the header menu.
 *
 * @since 1.0.0
 *
 * @param string $items The menu HTML.
 * @param array  $args The menu options.
 * @return string Updated menu HTML.
 */
function monochrome_add_search_menu_item( $items, $args ) {

	$search_toggle = sprintf( '<li class="menu-item">%s</li>', monochrome_get_header_search_toggle() );

	if ( 'primary' === $args->theme_location ) {
		$items .= $search_toggle;
	}

	return $items;

}

add_filter( 'wp_nav_menu_args', 'monochrome_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 1.0.0
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function monochrome_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}
	$args['depth'] = 1;
	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'monochrome_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function monochrome_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_post_info', 'monochrome_entry_meta_header' );
/**
 * Modifies the meta information in the entry header.
 *
 * @since 1.0.0
 *
 * @param string $post_info Current post info.
 * @return string New post info.
 */
function monochrome_entry_meta_header( $post_info ) {

	$post_info = '[post_author_posts_link] &middot; [post_date] &middot; [post_comments] [post_edit]';
	// $post_info = '[post_date] &nbsp; &nbsp; [post_categories sep before="" after=""] &nbsp; &nbsp; [post_tags before="" after=""] &nbsp; &nbsp; [post_edit]';
	return $post_info;

}

add_filter( 'genesis_post_meta', 'monochrome_entry_meta_footer' );
/**
 * Modifies the entry meta in the entry footer.
 *
 * @since 1.0.0
 *
 * @param string $post_meta Current post info.
 * @return string The new entry meta.
 */
function monochrome_entry_meta_footer( $post_meta ) {

	$post_meta = '[post_categories before=""] [post_tags before=""]';
	return $post_meta;

}

add_filter( 'genesis_comment_list_args', 'monochrome_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function monochrome_comments_gravatar( $args ) {

	$args['avatar_size'] = 48;
	return $args;

}

add_filter( 'get_the_content_limit', 'monochrome_content_limit_read_more_markup', 10, 3 );
/**
 * Modifies the generic more link markup for posts.
 *
 * @since 1.0.0
 *
 * @param string $output The current full HTML.
 * @param string $content The content HTML.
 * @param string $link The link HTML.
 * @return string The new more link HTML.
 */
function monochrome_content_limit_read_more_markup( $output, $content, $link ) {

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;

}

// Removes entry meta in entry footer.
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_action( 'genesis_before_footer', 'monochrome_before_footer_cta' );
/**
 * Hooks in before footer CTA widget area.
 *
 * @since 1.0.0
 */
function monochrome_before_footer_cta() {

	genesis_widget_area(
		'before-footer-cta',
		[
			'before' => '<div class="before-footer-cta"><div class="wrap">',
			'after'  => '</div></div>',
		]
	);

}

// Removes site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Adds site footer.
add_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
add_action( 'genesis_after', 'genesis_do_footer' );
add_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

// Registers widget areas.
genesis_register_sidebar(
	[
		'id'          => 'before-footer-cta',
		'name'        => __( 'Before Footer CTA', 'monochrome-pro' ),
		'description' => __( 'This is the before footer CTA section.', 'monochrome-pro' ),
	]
);

add_action( 'genesis_after', 'nl_render_footer' );
/**
 * Render custom footer.
 *
 * @since 1.3.0
 * @return void
 */
function nl_render_footer() {
	$data  = sprintf( '<p>Copyright &copy; %d', date( 'Y' ) );
	$data .= sprintf( ' - %s', get_bloginfo() );
	$data .= sprintf( ' - All rights reserved' );
	$data .= sprintf( ' - Developed with <abbr title="October 31st, 2019 &bull; Jakarta, Indonesia"><i class="fa fa-heart" aria-hidden="true"></i></abbr> by <a href="https://nielslange.com" target="_blank" title="Niels Lange | WordPress Developer"><strong>Niels Lange</strong></a><p>' );
	echo $data; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_filter( 'dashboard_glance_items', 'custom_glance_items', 10, 1 );
/**
 * Add CPTs to At a glace dashboard widget
 *
 * @param array $items The original array with post type items.
 * @return array $items The updated array with post type items.
 */
function custom_glance_items( $items = array() ) {
	$post_types = array( 'art-charity', 'tribe-member' );
	foreach ( $post_types as $type ) {
		if ( ! post_type_exists( $type ) ) {
			continue;
		}
		$num_posts = wp_count_posts( $type );
		if ( $num_posts ) {
			$published = intval( $num_posts->publish );
			$post_type = get_post_type_object( $type );
			$text      = _n( '%s ' . $post_type->labels->singular_name, '%s ' . $post_type->labels->name, $published, 'your_textdomain' );
			$text      = sprintf( $text, number_format_i18n( $published ) );
			if ( current_user_can( $post_type->cap->edit_posts ) ) {
				$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $text . '</a>';
				echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
			} else {
				$output = '<span>' . $text . '</span>';
				echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
			}
		}
	}
	return $items;
}
