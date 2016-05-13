<?php
/**
 * The template tag
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
get_header(); ?>
	<div class="content">
		<h2 class="page-title"><?php printf( __( 'Tag Archives: "%s"', 'cybergames' ), single_tag_title( '', false ) ); ?></h2>
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div class="post">
					<?php if ( has_post_thumbnail() ) : /* post thumbnail */ ?>
						<div class="post-main">
							<?php the_post_thumbnail( 'post-thumb' ); ?>
							<p><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?></p>
						</div><!-- .post-main -->
					<?php endif; /* post thumbnail */ ?>
					<div class="post-cybergames">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="category">
							<?php _e( 'Posted on', 'cybergames' ); ?> <a href="<?php the_permalink(); ?>"><?php echo get_the_date( 'j F, Y' ); ?></a>
							<?php if ( has_category() ) {
								printf( '&nbsp;' . __( 'in', 'cybergames' ) . '&nbsp;' );
								the_category( ', ' );
							} ?>
						 </p>
						<div class="post-content wp-caption-text" >
						<?php the_content();
						/* Place pagination if exist. */
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cybergames' ), 'after' => '</div>' ) ); ?>
						</div>
						<p class="tags"><?php the_tags( '',', ' ); ?></p>
						<p class="top-cbg"><a href='javascript:void(0)' onclick="scroll(0,0)"><?php _e( '[Top]', 'cybergames' ); ?></a></p>
					</div><!-- .post-cbg -->
				</div><!-- .post -->
			<?php endwhile; ?>
			<div class="pagination">
				<div class="cybergames-nav-previous"><?php next_posts_link( __( '&larr; Older Posts', 'cybergames' ) ); ?></div>
				<div class="cybergames-nav-next"><?php previous_posts_link( __( 'Newer Posts &rarr;', 'cybergames' ) ); ?></div>
				<div class="clear"></div>
			</div><!--.pagination-->
		<?php else :
		endif; ?>
	</div><!--content-->
<?php get_sidebar();
get_footer();
