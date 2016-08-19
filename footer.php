<?php
/**
* The template  footer
*
* @subpackage CyberGames
* @since CyberGames 1.4
*/
?>
		<footer class="footer">
			<p class="footer-copy" ><?php printf( '&copy; %1$s %2$s', date_i18n( 'Y' ),  get_bloginfo( 'name' ) ) ?></p>
			<p class="footer-right" ><?php _e( 'Powered by', 'cybergames' ); ?> <a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>">BestWebLayout</a> <?php _e( 'and', 'cybergames' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>">WordPress</a></p>
			<div class="clear"></div>
		</footer>
	</div><!-- frame-cbg -->
</div> <!-- cbg-site -->
<?php wp_footer(); ?>
</body>
</html>
