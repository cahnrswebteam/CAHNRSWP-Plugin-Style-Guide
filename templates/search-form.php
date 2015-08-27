<form role="search" method="get" class="cahnrs-search" action="<?php echo home_url( '/' ); ?>">
	<input type="hidden" name="post_type" value="style-guide">
	<label>
		<span class="screen-reader-text">Search Style Guide</span>
		<input type="search" class="search-field" placeholder="Search Style Guide" value="<?php echo get_search_query(); ?>" name="s" title="Search Style Guide" />
	</label>
	<input type="submit" class="search-submit" value="$" />
</form>