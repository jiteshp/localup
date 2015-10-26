<?php
/**
 *	Index template
 *	
 *	This file contains the loop, and loads the appropriate template part.
 *
 *	@package localup
 *	@since LocalUp 1.0
 *	----------------------------------------------------------------------------
 */

if( have_posts() ) {
	while( have_posts() ) {
		the_post();
		
		if( is_page() ) {
			get_template_part( 'inc/entry', 'page' );
		}
		elseif( is_single() ) {
			get_template_part( 'inc/entry', 'single' );
		}
		elseif( is_search() ) {
			get_template_part( 'inc/entry', 'search' );
		}
		else {
			get_template_part( 'inc/entry' );
		}
	}
	
	the_posts_pagination( array(
		'next_text'	=> '<i class="fa fa-chevron-right"></i>',
		'prev_text'	=> '<i class="fa fa-chevron-left"></i>',
	) );
}
else {
	get_template_part( 'inc/entry', 'none' );
}