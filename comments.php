<?php
/**
 * The template Comments
 *
 * Page which contains comments and comment form.
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
if ( post_password_required() ) {
	return;
}
	// You can start editing here -- including this comment!
if ( have_comments() || comments_open() ) : ?>
	<div id="comments" class="comments-area">
		<h2 class="comments-title">
			<?php printf( _n( 'One Thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'cybergames' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
		</h2>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'cybergames_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'cybergames' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cybergames' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cybergames' ) ); ?></div>
			</nav>
		<?php endif; // check for comment navigation
		/* If there are no comments and comments are closed, let's leave a note.
		* But we only want the note on posts and pages that had comments in the first place.*/
		if ( ! comments_open() && get_comments_number() ) { ?>
			<p class="nocomments"><?php _e( 'Comments are closed.' , 'cybergames' ); ?></p>
		<?php }
		comment_form(); ?>
	</div><!-- #comments .comments-area -->
<?php endif; // have_comments()
