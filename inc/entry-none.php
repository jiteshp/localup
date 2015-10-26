<?php
/**
 *	No results
 *	
 *	Displays a message when nothing is available to be shown.
 *
 *	@package localup
 *	@since LocalUp 1.0
 *	----------------------------------------------------------------------------
 */ ?>
 
<div class="no-results">
	<header>
		<h1>Nothing found.</h1>
	</header>
	
	<div>
		<?php
		if( is_home() ) {
			printf( '<p>Ready to publish your first post? <a href="%1$s">Get started here</a>.</p>',
				esc_url( admin_url( 'post-new.php' ) ) );
		}
		elseif( is_search() ) {
			printf( '<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>' );
			get_search_form();
		}
		else {
			printf( '<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>' );
			get_search_form();
		} ?>
	</div>
</div>