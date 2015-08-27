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

			<?php load_template( __DIR__ . '/table-of-contents.php' ); ?>

		</div>

		<div class="column two">

			<?php load_template( __DIR__ . '/search-form.php' ); ?>

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