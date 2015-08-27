<?php get_header(); ?>

<main>

	<?php get_template_part('parts/headers'); ?>

	<section class="row single gutter pad-top">

		<div class="column one">

			<p><a href="<?php echo get_post_type_archive_link( 'style-guide' ); ?>">Style Guide</a> &raquo; Search results for “<?php echo get_search_query(); ?></p>

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

			<?php load_template( __DIR__ . '/search-form.php' ); ?>

			<h3>Table of Contents</h3>

			<?php load_template( __DIR__ . '/table-of-contents.php' ); ?>

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