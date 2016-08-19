<?php
/**
 * The sidebar containing the secondary widget area
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
?>
	<div class="sidebar">
		<?php if ( is_active_sidebar( 'sidebar' ) ) :
			dynamic_sidebar( 'sidebar' );
		else : ?>
			<aside class="search">
				<?php get_search_form(); ?>
			</aside>
		<?php endif; ?>
	</div><!--.sidebar-->
</div><!--content-main-->
