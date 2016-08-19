<?php
/**
 * The template file functions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * @link       http://codex.wordpress.org/
 *
 * @subpackage CyberGames
 * @since      CyberGames 1.4
 */

/*cybergames_setup*/
function cybergames_setup() {
	global $content_width;
	/**support thumbnails**/
	if ( ! isset( $content_width ) ) {
		$content_width = 620;
	}
	/**support for translation**/
	load_theme_textdomain( 'cybergames', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	/**support header**/
	add_theme_support( 'custom-header', array(
		'default-text-color'     => 'ffffff',
		'default-image'          => '',
		'height'                 => 250,
		'width'                  => 940,
		'max-width'              => 940,
		'flex-height'            => true,
		'flex-width'             => false,
		'random-default'         => false,
		'wp-head-callback'       => 'cybergames_header_style',
		'admin-head-callback'    => 'cybergames_admin_header_style',
		'admin-preview-callback' => 'cybergames_admin_header_image',
	) );
	/* This theme supports a variety of post formats. */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	/**body-background**/
	add_theme_support( 'custom-background', array(
		'default-color'          => '13181e',
		'default-image'          => '',
		'uploads'                => true,
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	) );

	add_editor_style();
	/**This theme uses in one location.**/
	register_nav_menu( 'primary', __( 'Primary Menu', 'cybergames' ) );
}

/*widget*/
function cybergames_widgets_init() {
	register_sidebar( array(
		'name'          => 'widget sidebar',
		'id'            => 'sidebar',
		'description'   => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'cybergames' ),
		'before_widget' => '<aside class="widget_meta">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}

/* Including the javascript and css of the theme. */
function cybergames_scripts() {
	wp_enqueue_script( 'cybergamesScript', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
	wp_enqueue_script( 'cybergamesSlides', get_template_directory_uri() . '/js/jquery.slides.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'cybergamesHtml5', get_template_directory_uri() . '/js/html5.js', array( 'jquery' ) );
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'cybergamesStyle', get_template_directory_uri() . '/style.css', false, null );

	/* Define vars for input:file */
	$localize_array = array( 'cbg_home_url' => esc_url( home_url() ) );
	wp_localize_script( 'cybergamesScript', 'cybergamesScript_localization', $localize_array );
}

/*Style the header text displayed on the blog*/
function cybergames_header_style() {
	$text_color = get_header_textcolor();
	/* If no custom options for text are set, let's bail */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) == $text_color ) {
		return;
	}
	/* If we get this far, we have custom styles. */ ?>
	<style type="text/css" id="cybergames-header-css">
		<?php /* Has the text been hidden? */
		if ( ! display_header_text() ) : ?>
			.site-title h1 {
				margin: 0;
			}

			.site-title h1 a,
			.site-title p {
				position: absolute;
				clip: rect(1px 1px 1px 1px); /* IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}

		<?php /* If the user has set a custom color for the text, use that. */
		else : ?>
			.site-title h1 a,
			.site-title p {
				color: <?php echo '#' . $text_color; ?>;
			}

		<?php endif; ?>
	</style>
<?php }

/* Style the header image displayed on the Appearance > Header admin panel */
function cybergames_admin_header_style() {
	wp_enqueue_style( 'cybergamesAdminStyle', get_template_directory_uri() . '/css/admin.css', false, null );
	/* Add background to admin header style. */
	$background_color = get_background_color(); ?>
	<style type="text/css" id="cybergames-header-css">
	#wpbody .form-table .site-title {
		background: <?php echo '#' . $background_color; ?>;
	}
	</style>
<?php }

/* Output markup to be displayed on the Appearance > Header admin panel */
function cybergames_admin_header_image() { ?>
	<div class="site-title">
		<?php if ( ! display_header_text() ) { ?>
			<h1 class="cybergames-site-title displaying-header-text" style="display: none;">
				<a id="name" href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<p class="site-description displaying-header-text" id="desc" style="display: none;"><?php bloginfo( 'description' ); ?></p>
		<?php } else { ?>
			<h1 class="cybergames-site-title displaying-header-text">
				<a id="name" href="<?php echo esc_url( home_url() ); ?>" style="color: <?php echo '#' . get_header_textcolor(); ?>;"><?php bloginfo( 'name' ); ?></a>
			</h1>
			<p class="site-description displaying-header-text" id="desc" style="color: <?php echo '#' . get_header_textcolor(); ?>;"><?php bloginfo( 'description' ); ?></p>
		<?php } // ! display_header_text() ?>
	</div>
	<div class="clear"></div>
	<?php do_action( 'cybergames_custom_header' ); ?>
<?php }

/*custom-header background*/
function cybergames_custom_header() {
	if ( get_header_image() ) {
		printf( '<div id="cbg-custom-image-image" class="aligncenter"><img src="%s" width="%dpx" height="%dpx"></div><!--.cbg-custom-image-image-->',
			get_custom_header()->url,
			get_custom_header()->width,
			get_custom_header()->height
		);
	}
}

/*Thumbnail*/
function cybergames_thumbnail( $post_id ) {
	$thumbnail = get_the_post_thumbnail( $post_id );
	if ( $thumbnail ) { ?>
		<div class="post-main">
			<?php /*condition for caption */
			the_post_thumbnail( 'post-thumbnail' );
			$tmp = get_post( get_post_thumbnail_id( $post_id ) );
			if ( '' !== trim( $tmp->post_excerpt ) ) { ?>
				<p><?php echo $tmp->post_excerpt; ?></p>
			<?php } ?>
		</div><!-- .post-main -->
	<?php }
}

/*comments*/
function cybergames_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'cybergames' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'cybergames' ), '<span class="edit-link">', '</span>' ); ?></p>
			</li>
			<?php break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<div class="comment-meta comment-author vcard">
						<?php echo get_avatar( $comment, 44 );
						printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'cybergames' ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'cybergames' ), get_comment_date(), get_comment_time() )
						); ?>
					</div>
					<!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cybergames' ); ?></p>
					<?php endif; ?>
					<section class="comment-content comment">
						<?php comment_text();
						edit_comment_link( __( 'Edit', 'cybergames' ), '<p class="edit-link">', '</p>' ); ?>
					</section>
					<!-- .comment-content -->
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'cybergames' ),
							'after'      => ' <span>&darr;</span>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) ); ?>
					</div>
					<!-- .reply -->
				</article>
				<!-- #comment-## -->
			</li>
			<?php
			break;
	endswitch; // end comment_type check
}

/*add meta_box*/
function cybergames_add_metabox_for_slider() {
	add_meta_box( 'metabox_slider_id', __( 'Slider Post', 'cybergames' ), 'cybergames_metabox_callback', 'post', 'side' );
}

/*callback function for meta box*/
function cybergames_metabox_callback() {
	global $post;
	$screen = get_current_screen(); ?>
	<input type='checkbox' name='cbg_add_to_slider' id='cbg_add_to_slider' value='on' <?php if ( 'on' == get_post_meta( $post->ID, 'cbg_add_to_slider', true ) ) { ?> checked='checked' <?php } ?> />
	<label for='cbg_add_to_slider'><?php echo '&nbsp' . __( 'Display this', 'cybergames' ) . '&nbsp' . $screen->post_type . '&nbsp' . __( 'in slider', 'cybergames' ); ?></label>
<?php }

/*save meta box data*/
function cybergames_save_box_data( $post_id ) {
	global $post, $post_id;
	if ( wp_is_post_revision( $post_id ) ) {
		return $post_id;
	}
	if ( null != $post ) {
		if ( isset( $_POST['cbg_add_to_slider'] ) && 'on' == $_POST['cbg_add_to_slider'] ) {
			update_post_meta( $post->ID, 'cbg_add_to_slider', $_POST['cbg_add_to_slider'] );
		} else {
			update_post_meta( $post->ID, 'cbg_add_to_slider', 'off' );
		}
	}
}

/*Saving metaboxes*/
function cybergames_slidecaption_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
}

/*slider*/
function cybergames_slider_template() {
	$args     = array(
		'post_type'           => array( 'post', 'page' ),
		'posts_per_page'      => - 1,
		'meta_value'          => 'on',
		'meta_key'            => 'cbg_add_to_slider',
		'ignore_sticky_posts' => 1,
	);
	$wp_query = new WP_Query( $args ); ?>
	<?php if ( $wp_query->have_posts() ) : ?>
		<div class="container">
			<div id="slides">
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<div class="slidesjs-slide">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							} ?>
							<div class="slider-text">
								<h1><?php the_title(); ?></h1>
								<?php the_excerpt(); ?>
							</div>
						</a>
					</div><!--.slidesjs-slide-->
				<?php endwhile;
				wp_reset_query(); ?>
			</div>
		</div><!--.container-->
	<?php else : endif;
	/*Reset Post Data*/
	wp_reset_postdata();
}

/*hooks*/
add_action( 'after_setup_theme', 'cybergames_setup' );
add_action( 'widgets_init', 'cybergames_widgets_init' );
add_action( 'wp_enqueue_scripts', 'cybergames_scripts' );
add_action( 'save_post', 'cybergames_slidecaption_save' );
add_action( 'save_post', 'cybergames_save_box_data' );
add_action( 'add_meta_boxes', 'cybergames_add_metabox_for_slider' );
add_action( 'cybergames_custom_header', 'cybergames_custom_header' );
add_action( 'cybergames_thumbnail', 'cybergames_thumbnail' );
add_action( 'cbg_slides_template', 'cybergames_slider_template' );
