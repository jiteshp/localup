<?php
if( post_password_required() ) {
	return;
} ?>
<!-- entry-comments -->
<div id="comments" class="entry-comments">
	<?php 
	if( have_comments() ): ?>
	<p class="comments-title">
		<span>
			<i class="fa fa-comment-o"></i>
			<?php 
			comments_number( 'No comments yet', 
				'One comment', '% comments' ); ?>.
		</span>
		
		<span>
			<a href="#respond">Add yours</a>.
		</span>
	</p>
	
	<ol class="comments-list">
		<?php
		wp_list_comments( array(
			'avatar_size'	=> 50,
			'max_depth'		=> 2,
			'type'			=> 'comment',
		) ); ?>
	</ol> <?php
	endif;

	if( ! comments_open() ): ?>
	<p class="note comments-closed">Comments are closed.</p> <?php
	endif;

	comment_form( array(
		'comment_notes_after'	=> null,
		'comment_notes_before'	=> null,
	) ); ?>
</div>