<?php
/**
 *The template file pages.
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
get_header(); ?>
	<div class="content">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div class="post">
					<div class="post-cbg"> 
						<h2><?php the_title(); ?></h2>
						<p class="category"></p>
						<?php the_content();
						/* Place pagination if exist. */
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cybergames' ), 'after' => '</div>' ) ); ?>
						<p class="top-cbg"><a href='javascript:void(0)' onclick="scroll(0,0)"><?php _e( '[Top]', 'cybergames' ); ?></a></p>
					</div><!-- .post-cbg -->
				</div><!-- .post -->
				<?php comments_template();
			 endwhile; ?>
				<div class="pagination">
					<div class="alignleft"><?php previous_post_link( '%link ', '&larr; %title' ); ?></div>
					<div class="alignright" ><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
					<div class="clear"></div>
				</div><!-- .pagination -->
		<?php else :
		endif; ?>
	</div><!-- .content -->
<?php get_sidebar();
get_footer();
