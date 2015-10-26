(function ($) {
	
	$(document).ready( function() {
		// fitvids
		$( '.entry-content' ).fitVids(  
			{ customSelector: "iframe[src^='www.slideshare.net']" }
		);
		
		// primary navigation toggle
		$( '#nav-menu .toggle' ).click( function( e ) {
			$( this ).find( 'i.fa' ).toggleClass( 'fa-bars' ).toggleClass( 'fa-times' );
			$( '#nav-menu .menu' ).slideToggle();
			e.preventDefault();
		} );
		
		// window resize
		$( window ).resize( function() {
			if( $( window ).width() >= 960 ) {
				$( '#nav-menu .menu' ).show();
				$( '#nav-menu .toggle' ).hide();
			}
			else {
				if( ! $( '#nav-menu .menu' ) .is( ':visible' ) ) {
					$( '#nav-menu .menu' ).hide();
					$( '#nav-menu .toggle' ).show();
				}
			}
		} );
		
		// match heights
		$( '.gallery-item, .row [class*="col-"]' ).matchHeight();
		
		// scroll to
		
		// scrollto
		$( 'a[href^="#"]' ).click( function( e ) {
			e.preventDefault();
			$( window ).stop( true ).scrollTo( this.hash, { duration:1000, interrupt:true } );
		} );
	} );
	
}(jQuery));