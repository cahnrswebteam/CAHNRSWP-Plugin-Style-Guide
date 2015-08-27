<?php
/*
Plugin Name: CAHNRSWP Style Guide
Description: Create an online style guide.
Author: CAHNRS, philcable
Version: 0.1.1
*/

class CAHNRSWP_Style_Guide {

	/**
	 * @var string Content type slug.
	 */
	var $style_guide_content_type = 'style-guide';

	/**
	 * Start the plugin and apply associated hooks.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ), 11 );
		add_filter( 'spine_sub_header_default', array( $this, 'spine_sub_header_default' ), 10, 2 );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_filter( 'template_include', array( $this, 'template_include' ), 1 );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
	}

	/**
	 * Register the Style Guide post type.
	 */
	public function init() {

		$labels = array(
			'name'                => 'Style Guide',
			'singular_name'       => 'Style Guide Article',
			'menu_name'           => 'Style Guide',
			'parent_item_colon'   => 'Parent Article:',
			'all_items'           => 'All Articles',
			'view_item'           => 'View Article',
			'add_new_item'        => 'Add New Article',
			'add_new'             => 'Add New',
			'edit_item'           => 'Edit Article',
			'update_item'         => 'Update Article',
			'search_items'        => 'Search Article',
			'not_found'           => 'Not found',
			'not_found_in_trash'  => 'Not found in Trash',
		);

		$args = array(
			'label'               => 'style-guide',
			'description'         => 'A style guide for numbered WSU Extension publications, CAHNRS marketing materials, and department or program newsletters.',
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'author', 'revisions', 'page-attributes', ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-book-alt',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		register_post_type( $this->style_guide_content_type, $args, 0 );

	}

	/**
	 * spine_sub_header_default
	 */
	public function spine_sub_header_default() {
		if ( $this->style_guide_content_type === get_post_type() && is_singular() ) {
			return 'Style Guide';
		}
	}

	/**
	 * Enqueue the scripts and styles used on the front end.
	 */
	public function wp_enqueue_scripts() {
		if ( $this->style_guide_content_type === get_post_type() ) {
			wp_enqueue_style( 'style-guide', plugins_url( 'css/styleguide.css', __FILE__ ), array() );
			wp_enqueue_script( 'style-guide', plugins_url( 'js/styleguide.js', __FILE__ ), array( 'jquery' ), '0.1', true );
		}
	}

	/**
	 * Add templates for the Style Guide post type.
	 *
	 * @param string $template
	 *
	 * @return string template path
	 */
	public function template_include( $template ) {
		if ( $this->style_guide_content_type == get_post_type() ) {
			$template = __DIR__ . '/templates/single.php';
		}
		if ( is_post_type_archive( $this->style_guide_content_type ) ) {
			if ( is_search() ) {
				$template = __DIR__ . '/templates/search-results.php';
			} else {
				$template = __DIR__ . '/templates/index.php';
			}
		}
		return $template;
	}

	/**
	 * Register widget areas.
	 */
	public function widgets_init() {
		register_sidebar( array(
			'name'          => 'Style Guide TOC',
			'id'            => 'style-guide',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );
		register_sidebar( array(
			'name'          => 'Style Guide TOC Sidebar',
			'id'            => 'style-guide-sidebar',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );
	}

}

new CAHNRSWP_Style_Guide();