<?php get_header(); ?>

<main>

	<?php get_template_part('parts/headers'); ?>

	<section class="row single gutter pad-top">

		<div class="column one">

			<?php
				echo '<p><a href="' . get_post_type_archive_link( 'style-guide' ) . '">Style Guide</a> &raquo; Search results for “' . get_search_query() . '”</p>';
			?>

		</div>

	</section>

	<section class="row side-right gutter pad-bottom">

		<div class="column one">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="article-header">
							<hgroup>
								<h2 class="article-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
								</h2>
							</hgroup>
							<!--<hgroup class="source">
								<time class="article-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
							</hgroup>-->
						</header>

						<div class="article-summary">
							<?php the_content(); ?>
						</div>

					</article>

				<?php endwhile; ?>

			<?php else: ?>

				<p>No results found.</p>

			<?php endif; ?>

		</div><!--/column-->

		<div class="column two">

			<form role="search" method="get" class="cahnrs-search" action="<?php echo home_url( '/' ); ?>">
				<input type="hidden" name="post_type" value="style-guide">
				<label>
					<span class="screen-reader-text">Search Style Guide</span>
					<input type="search" class="search-field" placeholder="Search Style Guide" value="<?php echo get_search_query(); ?>" name="s" title="Search Style Guide" />
				</label>
				<input type="submit" class="search-submit" value="$" />
			</form>

			<h3>Table of Contents</h3>
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

			<?php
				if ( is_active_sidebar( 'style-guide-sidebar' ) ) {
					dynamic_sidebar( 'style-guide-sidebar' );
				}
			?>

		</div><!--/column two-->

	</section>


	<?php get_template_part( 'parts/footers' ); ?>

</main><!--/#page-->

<?php get_footer(); ?>