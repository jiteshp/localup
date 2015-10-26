<?php
/**
 *	Search entry
 *	
 *	Displays a single entry in a search index.
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
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>"
				   rel="bookmark"><?php the_title(); ?></a>
			</h1>
		</header> <?php
	} 
	
	if( '' != get_the_content() ) { ?>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div> <?php
	} ?>
</article> <?php
}