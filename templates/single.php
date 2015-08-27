<?php get_header(); ?>

<main>

	<?php get_template_part('parts/headers'); ?>

	<section class="row single gutter pad-top">

		<div class="column one">

			<?php
				echo '<p><a href="' . get_post_type_archive_link( 'style-guide' ) . '">Style Guide</a> &raquo; ';
				$ancestors = get_ancestors( get_the_ID(), 'style-guide' );
				if ( $ancestors ) {
					$ancestors = array_reverse( $ancestors );
					foreach ( $ancestors as $ancestor ) {
						echo '<a href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a> &raquo; ';
					}
				}
				echo '</p>';
			?>

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
						<!--<hgroup class="source">
							<time class="article-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
						</hgroup>-->
					</header>

					<div class="article-body">
						<?php the_content(); ?>
					</div>

				</article>

			<?php endwhile; ?>

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