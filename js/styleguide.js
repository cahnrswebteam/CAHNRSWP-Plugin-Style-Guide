(function($){

	$( '.style-guide-toc.article li:not(.current_page_ancestor):not(.current_page_item) ul' ).hide();

	$( '.style-guide-toc.article li.current_page_item > a > span, .style-guide-toc li.current_page_ancestor > a > span, .style-guide-toc:not(.article) li a span' ).addClass( 'disclosed' );

	$( '.style-guide-toc a' ).on( 'click', 'span', function( event ) {
		event.preventDefault();
		$(this).toggleClass( 'disclosed' ).parents( 'a' ).next( 'ul' ).toggle();
	})

	$( '.style-guide-toc li:not(.current_page_item) a span' ).hover(
  	function() {
    	$(this).parents( 'a' ).css( 'color', '#981e32' );
  	}, function() {
    	$(this).parents( 'a' ).removeAttr( 'style' );
  	}
	);

}(jQuery));