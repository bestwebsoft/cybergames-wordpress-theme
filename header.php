<?php
/**
 * The Header template
 *
 * @subpackage CyberGames
 * @since CyberGames 1.4
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="cbg-site">
		<div class="frame-cbg">
			<header class="header aligncenter">
				<div class="site-title">
					<h1 class="cybergames-site-title"><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<p><?php bloginfo( 'description' ); ?></p>
				</div><!--.site-title-->
				<nav class="header-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- .header-menu -->
				<div class="clear"></div>
				<?php do_action( 'cybergames_custom_header' ); ?>
			</header><!--.header-->
			<div class="content-main"><!--content-main-->
				<?php do_action( 'cbg_slides_template' ); ?><!--slider-->
			<div class="clear"></div>
