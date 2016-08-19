<?php
/**
 * The template for displaying 404 pages Nothing found...
 *
 * @subpackage CyberGames
 * @since      CyberGames 1.4
 */
get_header(); ?>
		<div class="content">
			<h2 class="page-title"><?php _e( 'Nothing found...', 'cybergames' ); ?></h2>
			<div class="post">
				<div class="search-form-cbg">
					<div class="search-cbg">
						<?php get_search_form(); ?>
					</div><!--.search-cbg-->
				</div><!--.search-form-cbg-->
			</div><!--.post-->
		</div><!--content-->
	<?php get_sidebar(); ?>
</div><!--content-main-->
<?php get_footer();
