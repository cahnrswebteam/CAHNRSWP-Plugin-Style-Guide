<?php get_header(); ?>

<main class="spine-archive-index">

	<?php get_template_part('parts/headers'); ?>

	<section class="row side-right gutter pad-ends">

		<div class="column one">

			<header class="article-header">
				<h1 class="article-title">Style Guide</h1>
			</header>

			<?php echo wpautop( wp_kses_post( get_option( 'style_guide_about' ) ) ); ?>

			<h2>Table of Contents</h2>

			<?php load_template( __DIR__ . '/table-of-contents.php' ); ?>

		</div>

		<div class="column two">

			<?php load_template( __DIR__ . '/search-form.php' ); ?>

			<?php echo wpautop( wp_kses_post( get_option( 'style_guide_footer' ) ) ); ?>

		</div>

	</section>

</main>

<?php

get_footer();