<?php
/**
 *	Page entry
 *	
 *	Displays a single page and it's comments.
 *
 *	@package localup
 *	@since LocalUp 1.0
 *	----------------------------------------------------------------------------
 */

if( '' != get_the_title() || '' != get_the_content() ) { ?>
<article <?php post_class(); ?>>
	<?php
	if( '' != get_the_title() ) { ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header> <?php
	} 
	
	if( '' != get_the_content() ) { ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div> <?php
	} ?>
</article> <?php
}

if( comments_open() || get_comments_number() ) {
	comments_template();
}