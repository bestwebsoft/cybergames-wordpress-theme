<?php
/**
 * The template file index
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
get_header(); ?>
	<div class="content">
		<?php if ( have_posts() ) : $post = $posts[0]; $counter = 0;
			while ( have_posts() ) : the_post(); $counter++;
				if ( ! $paged && 1 == $counter ) : ?>
					<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php if ( has_post_thumbnail() ) : /* post thumbnail */
							$post_id = get_the_ID();
							$format = get_post_format( $post_id );
							do_action( 'cybergames_thumbnail', $post_id );
						endif; /* post thumbnail */ ?>
						<div class="post-cbg"> 
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<p class="category">
								<?php echo __( 'Posted on', 'cybergames' ) . '&nbsp;'; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date() ?></a>
								<?php if ( has_category() ) {
									echo '&nbsp;' . __( 'in', 'cybergames' ) . '&nbsp;';
									the_category( ', ' );
								} ?>
							</p>
							<div class="post-content wp-caption-text"><?php the_content( 'more_link_text' ); ?></div>
							<p class="tags" ><?php the_tags( '',', ' ); ?></p>
						</div><!--.post-cbg-->
					</div>
				<?php else : ?>
					<section id="post-<?php the_ID(); ?>">
						<?php if ( has_post_thumbnail() ) : /* post thumbnail */
							$post_id = get_the_ID();
							$format = get_post_format( $post_id );
							do_action( 'cybergames_thumbnail', $post_id );
						endif; /* post thumbnail */ ?>
						<div class="post-cbg"> 
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<p class="category">
								<?php echo __( 'Posted on', 'cybergames' ) . '&nbsp;'; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date() ?></a>
								<?php if ( has_category() ) {
									echo '&nbsp;' . __( 'in', 'cybergames' ) . '&nbsp;';
									the_category( ', ' );
								} ?>
							</p>
							<div class="post-cbg-content">
								<?php the_content();
								/* Place pagination if exist. */
								wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cybergames' ), 'after' => '</div>' ) ); ?>
							</div>
							<p class="tags" >
								<?php the_tags( '',', ' ); ?>
							</p>
							<p class="top-cbg"><a href='javascript:void(0)' onclick="scroll(0,0)"><?php _e( '[Top]', 'cybergames' ); ?></a></p>
						</div>
					</section>
				<?php endif;
			endwhile; ?>
				<div class="pagination">
					<div class="cybergames-nav-previous"><?php next_posts_link( __( '&larr; Older Posts', 'cybergames' ) ); ?></div>
					<div class="cybergames-nav-next"><?php previous_posts_link( __( 'Newer Posts &rarr;', 'cybergames' ) ); ?></div>
					<div class="clear"></div>
				</div><!-- pagination -->
			<?php else : ?>
				<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="post-cbg"> 
							<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'cybergames' ); ?></p>
							<?php get_search_form(); ?>
					</div><!--.post-cbg-->
				</div>
			<?php endif; ?>
		</div><!--.content-->
	<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer();
