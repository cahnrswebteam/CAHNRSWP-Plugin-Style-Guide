<ul class="style-guide-toc">
<?php
	wp_list_pages( array(
		'link_before' => '<span></span>',
		'post_type'   => 'style-guide',
		'sort_column' => 'menu_order',
		'title_li'    => '',
	) );
?>
</ul>