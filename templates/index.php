<?php get_header(); ?>

<main class="spine-archive-index">

	<?php get_template_part('parts/headers'); ?>

	<section class="row side-right gutter pad-ends">

		<div class="column one">

			<?php
				if ( is_active_sidebar( 'style-guide' ) ) {
					dynamic_sidebar( 'style-guide' );
				}
			?>

			<h2>Table of Contents</h2>

			<?php
				// Table of contents
				echo '<ul class="style-guide-toc">';
				wp_list_pages( array(
					//'link_after'  => '<span></span>',
					'link_before'  => '<span></span>',
					'post_type'    => 'style-guide',
					'sort_column'  => 'menu_order',
					'title_li'     => '',
				) );
				echo '</ul>';
			?>

		</div>

		<div class="column two">

			<form role="search" method="get" class="cahnrs-search" action="<?php echo home_url( '/' ); ?>">
				<input type="hidden" name="post_type" value="style-guide">
				<label>
					<span class="screen-reader-text">Search Style Guide</span>
					<input type="search" class="search-field" placeholder="Search Style Guide" value="<?php echo get_search_query(); ?>" name="s" title="Search Style Guide" />
				</label>
				<input type="submit" class="search-submit" value="$" />
			</form>

			<?php
				if ( is_active_sidebar( 'style-guide-sidebar' ) ) {
					dynamic_sidebar( 'style-guide-sidebar' );
				}
			?>

		</div>

	</section>

</main>

<?php

get_footer();