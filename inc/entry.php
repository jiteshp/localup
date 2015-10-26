<?php
/**
 *	Entry
 *	
 *	Displays a single entry in an archive and blog template.
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
			<?php
			if( localup_categorized_blog() ) { ?>
			<div class="entry-category">
				<?php the_category( ', ' ); ?>
			</div> <?php
			} ?>
		
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>"
				   rel="bookmark"><?php the_title(); ?></a>
			</h1>
			
			<div class="entry-meta">
				<span class="entry-author">
					by <?php the_author_link(); ?>
				</span>
				
				<span class="entry-time">
					on <?php the_time( 'F j, Y' ); ?>
				</span>
			</div>
		</header> <?php
	} 
	
	if( has_post_thumbnail() ) { ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>"
			   rel="bookmark"><?php the_post_thumbnail(); ?></a>
		</div> <?php
	}
	
	if( '' != get_the_content() ) { ?>
		<div class="entry-content"><?php the_excerpt(); ?></div> <?php
	} ?>
</article> <?php
}