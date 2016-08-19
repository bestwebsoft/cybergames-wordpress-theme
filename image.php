<?php
/**
 * The template  Category pages
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
get_header(); ?>
	<div class="content">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div <?php post_class() ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="post">
						<div class="post-cbg">
							<?php $metadata = wp_get_attachment_metadata(); ?>
							<p class="category" >
								<?php echo __( 'Posted on', 'cybergames' ) . '&nbsp;'; ?><a href="<?php the_permalink(); ?>"><?php echo get_the_date() ?></a>
								<?php if ( has_category() ) {
									echo '&nbsp;' . __( 'in', 'cybergames' ) . '&nbsp;';
									the_category( ', ' );
								} ?>
							</p>
							<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php _e( 'Return to', 'cybergames' ); echo ' ' . esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent );?></a>.
							<?php //show edit post link
							edit_post_link( __( '(Edit)', 'cybergames' ), ' <span class="edit-link">', '</span>' ); ?>
						</div><!-- post-cbg -->
						<div class="cybergames-attachment">
							<?php $attachments = array_values( get_children( array(
								'post_mime_type' => 'image',
								'post_status'	 => 'inherit',
								'post_parent' 	 => $post->post_parent,
								'post_type'		 => 'attachment',
								'orderby'		 => 'menu_order ID',
								'order'			 => 'ASC',
							) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID ) {
									break;
								}
							}
							//go to next image by click on attachment
							$k++;
							//if there is more than 1 attachment in a gallery
							if ( count( $attachments ) > 1 ) :
								if ( isset( $attachments[ $k ] ) ) :
									// get the url of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else :
									// or get the url of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[0]->ID );
								endif;
							else :
								// or, if there's only 1 image, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							endif; ?>
							<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, 'full' ); ?></a>
						</div><!-- .cybergames-attachment -->
						<div class="pagination">
							<div class="cybergames-nav-previous"><?php previous_image_link( false, __( 'Next', 'cybergames' ) . ' &rarr;' ); ?></div>
							<div class="cybergames-nav-next"><?php next_image_link( false, '&larr; ' .__( 'Previous', 'cybergames' ) ); ?></div>
							<div class="clear"></div>
						</div><!-- .pagination -->
					</div><!-- .post -->
				</div><!-- .cybergames-attachment -->
				<?php comments_template();
			endwhile;
		endif; ?>
	</div><!-- .content -->
<?php get_sidebar();
get_footer();
