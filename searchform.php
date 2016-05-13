<?php
/**
 * The template searchform
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
?>
<aside class="search">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" class="cbg-search">
		<input id="search" class="serch-txt" onclick="this.value=''" type="text" name="s" value="<?php _e( 'Enter search keyword' , 'cybergames' ); ?>"/>
		<input type="submit" name="submit" value=""/>
	</form><!--.cbg-search-->
</aside><!--.search-->
