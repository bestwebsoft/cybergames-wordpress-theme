<?php
/**
 * The template single
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
get_header( ); ?>
	<div class="content">
		<?php if ( have_posts() ) : the_post(); ?>
			<div class="post">
				<?php if ( has_post_thumbnail() ) : /* post thumbnail */
						$post_id = get_the_ID();
						$format = get_post_format( $post_id );
						do_action( 'cybergames_thumbnail', $post_id );
					endif; /* post thumbnail */ ?>
				<div class="post-cbg"> 
					<h2><?php the_title(); ?></h2>
					<p class="category">
						<?php echo __( 'Posted on', 'cybergames' ) . '&nbsp;'; ?><a href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>"><?php echo get_the_date() ?></a>
						<?php if ( has_category() ) {
							echo '&nbsp;' . __( 'in', 'cybergames' ) . '&nbsp;';
							the_category( ', ' );
						} ?>
					</p>
					<?php the_content();
					/* Place pagination if exist. */
					wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cybergames' ), 'after' => '</div>' ) ); ?>
					<p class="tags" ><?php the_tags( '',', ' ); ?></p>
					<div class="pagination">
						<div class="alignleft"><?php previous_post_link( '%link ', '&larr; %title' ); ?></div>
						<div class="alignright" ><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
						<div class="clear"></div>
					</div><!-- pagination -->
				</div><!-- .post-cbg -->
			</div><!-- .post -->
			<?php comments_template();
		else :
		endif; ?>
	</div><!--.content-->
<?php get_sidebar();
get_footer();
