<?php
/**
 *	Page header
 *	
 *	Displays a page header on archive and search indices.
 *
 *	@package localup
 *	@since LocalUp 1.0
 *	----------------------------------------------------------------------------
 */ ?>
<header id="page-header" class="col-xs-12">
	<?php
	if( is_archive() ) {
		the_archive_title( '<h1 id="page-title">', '</h1>' );
	}
	elseif( is_search() ) {
		printf( '<h1 id="page-title">Search results for: %s</h1>', 
			esc_html( get_search_query() ) );
	}
	elseif( is_home() != is_front_page() ) {
		printf( '<h1 id="page-title">Search results for: %s</h1>', 
			single_post_title( '', false ) );
	} ?>
</header>