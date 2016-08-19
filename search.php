<?php
/**
 * The template search
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
get_header(); ?>
	<div class="content">
		<h2 class="page-title"><?php _e( 'Search results:', 'cybergames' ); ?></h2>
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div class="post">
					<?php if ( has_post_thumbnail() ) : /* post thumbnail */ ?>
						<div class="post-main"> 
							<?php the_post_thumbnail( 'post-thumbnails' ); ?>
							<p><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?></p>
						</div>
					<?php endif; /* post thumbnail */ ?>
					<div class="post-cbg"> 
						<h2>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<p class="category" >
							<?php echo __( 'Posted on', 'cybergames' ) . '&nbsp;'; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date() ?></a>
							<?php if ( has_category() ) {
								echo '&nbsp;' . __( 'in', 'cybergames' ) . '&nbsp;';
								the_category( ', ' );
							} ?>
						</p>
						<p class="post-content"><?php the_excerpt(); ?></p>
						<p class="tags" ><?php the_tags( '',', ' ); ?></p>
						<p class="top-cbg"><a href='javascript:void(0)' onclick="scroll(0,0)"><?php _e( '[Top]', 'cybergames' ); ?></a></p>
					</div><!-- .post-cbg -->
				</div><!-- .post -->
			<?php endwhile; ?>
			<div class="pagination">
				<div class="cybergames-nav-previous"><?php next_posts_link( __( '&larr; Older Posts', 'cybergames' ) ); ?></div>
				<div class="cybergames-nav-next"><?php previous_posts_link( __( 'Newer Posts &rarr;', 'cybergames' ) ); ?></div>
				<div class="clear"></div>
			</div><!-- .pagination -->
		<?php else : ?>
			<p class="Nothing"><?php _e( 'Nothing found...', 'cybergames' ); ?></p>
			<div class="search-form-cbg">
				<div class="search-cbg">
					<?php get_search_form(); ?>
				</div>
			</div><!-- search-form-cbg -->
		<?php endif; ?>
	</div><!--content-->
<?php get_sidebar();
get_footer();
