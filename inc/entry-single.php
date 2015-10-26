<?php
/**
 *	Single entry
 *	
 *	Displays a single entry and it's comments.
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
		
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
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
			<?php the_post_thumbnail(); ?>
		</div> <?php
	}
	
	if( '' != get_the_content() ) { ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div> <?php
	} ?>
</article> <?php
}

if( is_active_sidebar( 'localup_afterpost_widgets' ) ) { ?>
<div id="after-post-widgets">
	<?php dynamic( 'localup_afterpost_widgets' ); ?>
</div> <?php
}

if( comments_open() || get_comments_number() ) {
	comments_template();
}