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
	var $style_guide_post_type = 'style-guide';

	/**
	 * Start the plugin and apply associated hooks.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ), 11 );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_filter( 'template_include', array( $this, 'template_include' ), 1 );
		add_filter( 'nav_menu_css_class', array( $this, 'nav_menu_css_class'), 100, 3 );
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
		register_post_type( $this->style_guide_post_type, $args, 0 );
	}

	/**
	 * Add options page link to the menu.
	 */
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=' . $this->style_guide_post_type, 'Style Guide Settings', 'Settings', 'manage_options', 'style_guide_settings', array( $this, 'style_guide_settings_page' ) );
	}

	/**
	 * Options page settings.
	 */
	public function admin_init() {
		register_setting( 'style_guide_options', 'style_guide_about' );
		register_setting( 'style_guide_options', 'style_guide_footer' );
		register_setting( 'style_guide_options', 'style_guide_menu_item' );
	}

	/**
	 * Options page content.
	 */
	public function style_guide_settings_page() {
		?>
		<div class="wrap">
			<h2>Style Guide Settings</h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'style_guide_options' ); ?>
				<?php do_settings_sections( 'style_guide_options' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Table of Contents Introductory Text</th>
						<td><?php wp_editor( wp_kses_post( get_option( 'style_guide_about' ) ), 'style_guide_about' ); ?></td>
					</tr>
					<tr valign="top">
						<th scope="row">Table of Contents Sidebar, Article Footer</th>
						<td><?php wp_editor( wp_kses_post( get_option( 'style_guide_footer' ) ), 'style_guide_footer' ); ?></td>
					</tr>
					<tr valign="top">
						<th scope="row">Style Guide Menu Item</th>
						<td>
							<p>Select a menu item to mark as active when viewing a style guide article.</p>
							<?php
								$menu_name = 'site';
								$locations = get_nav_menu_locations();
								if ( isset( $locations[ $menu_name ] ) ) :
									$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
									$menu_items = wp_get_nav_menu_items( $menu->term_id );
									?>
									<select name="style_guide_menu_item">
									<?php foreach ( $menu_items as $menu_item ) : ?>
										<option value="<?php echo $menu_item->ID; ?>" <?php selected( get_option( 'style_guide_menu_item' ), $menu_item->ID ); ?>><?php echo $menu_item->title; ?></option>
									<?php endforeach; ?>
									</select>
								<?php endif; ?>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Enqueue the scripts and styles used on the front end.
	 */
	public function wp_enqueue_scripts() {
		if ( $this->style_guide_post_type === get_post_type() ) {
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
		if ( $this->style_guide_post_type == get_post_type() ) {
			$template = __DIR__ . '/templates/single.php';
		}
		if ( is_post_type_archive( $this->style_guide_post_type ) ) {
			if ( is_search() ) {
				$template = __DIR__ . '/templates/search-results.php';
			} else {
				$template = __DIR__ . '/templates/index.php';
			}
		}
		return $template;
	}

	/**
	 * Apply 'dogeared' class to the "style_guide_menu_item" page when viewing a style guide article.
	 *
	 * @param array $classes Current list of nav menu classes.
	 * @param WP_Post $item Post object representing the menu item.
	 * @param stdClass $args Arguments used to create the menu.
	 *
	 * @return array Modified list of nav menu classes.
	 */
	public function nav_menu_css_class( $classes, $item, $args ) {
		$id = esc_attr( get_option( 'style_guide_menu_item' ) );
		$style_guide = $this->style_guide_post_type == get_post_type();
		$style_guide_archive = is_post_type_archive( $this->style_guide_post_type ); // May not be necessary
		if ( 'site' === $args->theme_location && $item->ID == $id && ( $style_guide || $style_guide_archive ) ) {
			$classes[] = 'dogeared';
		}
		return $classes;
	}

}

new CAHNRSWP_Style_Guide();