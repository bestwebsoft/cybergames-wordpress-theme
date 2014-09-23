<?php /**
 * The template Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
get_header(); ?>
	<div class="content">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<h2 class="page-title">
					<?php if ( is_day() ) 
						printf( __( 'Daily Archives: %s', 'cybergames' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) 
						printf( __( 'Monthly Archives: %s', 'cybergames' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
					elseif ( is_year() ) 
						printf( __( 'Yearly Archives: %s', 'cybergames' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
					else 
						_e( 'Archives', 'cybergames' ); ?>
				</h2><!-- .page-title -->
				<div class="post">
					<?php if ( has_post_thumbnail() ): /* post thumbnail */ ?>
						<div class="post-main"> 
							<?php the_post_thumbnail( 'post-thumbnails' ); ?>
							<p><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?></p>
						</div><!-- .post-main -->
					<?php endif; /* post thumbnail */ ?>
					<div class="post-cbg"> 
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="category">
							<?php printf( __( 'Posted on', 'cybergames' ) . '&nbsp;' ) ?><a href="<?php the_permalink(); ?>"><?php echo get_the_date( 'j F, Y' ) ?></a>
							<?php if ( has_category() ) printf( '&nbsp;' . __( 'in', 'cybergames' ) . '&nbsp;' ); the_category( ', ' ); ?>
						</p>
						<?php the_content();
						/* Place pagination if exist. */
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cybergames' ), 'after' => '</div>' ) ); ?>
						<p class="tags"><?php the_tags( '',', ' ); ?></p>
						<p class="top-cbg"><a href='javascript:void(0)' onclick="scroll(0,0)"><?php _e( '[Top]', 'cybergames' ); ?></a></p>
					</div><!-- .post-cbg -->
				</div><!-- .post -->
			<?php endwhile; ?>
			<div class="pagination">
				<div class="cybergames-nav-previous"><?php next_posts_link( __( '&larr; Older Posts', 'cybergames' ) ); ?></div>
				<div class="cybergames-nav-next"><?php previous_posts_link( __( 'Newer Posts &rarr;', 'cybergames' ) ); ?></div>
				<div class="clear"></div>
			</div><!-- .pagination -->
		<?php endif; ?>
	</div><!-- .content -->
<?php get_sidebar();
get_footer(); ?>