<?php get_header(); ?>

<main>

	<?php get_template_part('parts/headers'); ?>

	<section class="row single gutter pad-top">

		<div class="column one">

			<p><a href="<?php echo get_post_type_archive_link( 'style-guide' ); ?>">Style Guide</a> &raquo; <?php
					$ancestors = get_ancestors( get_the_ID(), 'style-guide' );
					if ( $ancestors ) {
						$ancestors = array_reverse( $ancestors );
						foreach ( $ancestors as $ancestor ) {
							echo '<a href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a> &raquo; ';
						}
					}
			?></p>

		</div>

	</section>

	<section class="row side-right gutter pad-bottom">

		<div class="column one">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="article-header">
						<hgroup>
							<h2 class="article-title"><?php the_title(); ?></h2>
						</hgroup>
					</header>

					<div class="article-body">
						<?php the_content(); ?>
					</div>

				</article>

			<?php endwhile; ?>

		</div><!--/column-->

		<div class="column two">

			<?php load_template( __DIR__ . '/search-form.php' ); ?>

			<h3>Table of Contents</h3>

			<?php load_template( __DIR__ . '/table-of-contents.php' ); ?>

		</div><!--/column two-->

	</section>

	<?php
		$pagelist = get_pages('sort_column=menu_order&sort_order=asc&post_type=style-guide');
		$pages = array();
		foreach ( $pagelist as $page ) {
   		$pages[] += $page->ID;
		}
		$current = array_search( get_the_ID(), $pages );
		$prev_ID = $pages[$current-1];
		$next_ID = $pages[$current+1];
	?>

	<footer class="main-footer">

		<section class="row halves pager prevnext gutter pad-ends">

			<div class="column one">

				<?php if ( ! empty( $prev_ID ) ) : ?>
					<a href="<?php echo get_permalink( $prev_ID ); ?>" rel="prev">&laquo; <?php echo get_the_title( $prev_ID ); ?></a>
				<?php endif; ?>

			</div>

			<div class="column two">

				<?php if ( ! empty( $next_ID ) ) : ?>
					<a href="<?php echo get_permalink( $next_ID ); ?>" rel="next"><?php echo get_the_title( $next_ID ); ?> &raquo;</a>
				<?php endif; ?>

			</div>

		</section><!--pager-->

		<section class="row single gutter pad-bottom">

			<div class="column one">

				<?php
					if ( is_active_sidebar( 'style-guide-sidebar' ) ) {
						dynamic_sidebar( 'style-guide-sidebar' );
					}
				?>

			</div>

		</section>

	</footer>

	<?php get_template_part( 'parts/footers' ); ?>

</main><!--/#page-->

<?php get_footer(); ?>