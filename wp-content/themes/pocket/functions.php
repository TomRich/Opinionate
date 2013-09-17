<?php
/**
 * Pocket functions and definitions
 *
 * @package Pocket
 * @since Pocket 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Pocket 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 770; /* pixels */

if ( ! function_exists( 'pocket_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since pocket 1.0
 */
function pocket_setup() {

	/* Add Customizer settings */
	require( get_template_directory() . '/customizer.php' );

	/* Initialize EDD update class */
	require( get_template_directory() . '/includes/updates/EDD_SL_Setup.php' );

	/* Add post styles */
	require_once( dirname( __FILE__ ) . "/includes/editor/add-styles.php" );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Add editor styles */
	add_editor_style();

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Default Thumb
	add_image_size( 'large-image', 9999, 9999, false ); // Large Post Image

	/* Add support for Post Formats */
	add_theme_support( 'post-formats', array(
	    'quote'
	) );

	/* Infinite Scroll Support */
	add_theme_support( 'infinite-scroll', array(
		'type'      => 'click',
		'container'	=> 'post-block',
		'render'	=> 'pocket_render_infinite_posts',
		'footer_widgets'      => false
	));

	/* Custom Background Support */
	add_theme_support( 'custom-background' );

	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( array(
		'primary' => __( 'Header Menu', 'okay' ),
		'custom' => __( 'Custom Menu', 'okay' )
	) );

	/* Make theme available for translation */
	load_theme_textdomain( 'okay', get_template_directory() . '/languages' );

}
endif; // pocket_setup
add_action( 'after_setup_theme', 'pocket_setup' );


/* Enqueue scripts and styles */
function okay_scripts_styles() {

	//Enqueue Styles

	//Pocket Stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	//Font Awesome CSS
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . "/includes/fonts/fontawesome/font-awesome.css", array(), '0.1', 'screen' );

	//Media Queries CSS
	wp_enqueue_style( 'media-queries-css', get_template_directory_uri() . "/media-queries.css", array(), '0.1', 'screen' );

	//Google Merriweather Font
	wp_enqueue_style( 'google-droid-serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' );

	wp_enqueue_style( 'google-raleway', 'http://fonts.googleapis.com/css?family=Raleway:300,500,700,800' );

	//Enqueue Scripts

	//Mobile JS
	wp_enqueue_script( 'mobile-menu-js', get_template_directory_uri() . '/includes/js/jquery.mobilemenu.js', array( 'jquery' ), false, true );

	//FidVid
	wp_enqueue_script( 'fitvid-js', get_template_directory_uri() . '/includes/js/jquery.fitvids.js', array(), false, true );

	//Custom JS
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/includes/js/custom.js', array( 'jquery', 'fitvid-js' ), false, true );

	//Localize scripts
	wp_localize_script('custom-js', 'custom_js_vars', array(
			'toggle_comments' => get_option('okay_theme_customizer_comment_toggle')
		)
	);

}

add_action( 'wp_enqueue_scripts', 'okay_scripts_styles' );


/* Add Customizer CSS To Header */
function okay_customizer_css() {
	?>
	<style type="text/css">
		a, #cancel-comment-reply i {
			color : <?php echo '' .get_theme_mod( 'okay_theme_customizer_accent', '#DD574C' )."\n";?>;
		}

		.next-prev a, #respond .respond-submit, .wpcf7-submit, .header .search-form .submit, .search-form .submit {
			background : <?php echo '' .get_theme_mod( 'okay_theme_customizer_accent', '#DD574C' )."\n";?>;
		}

		<?php echo '' .get_theme_mod( 'okay_theme_customizer_css', '' )."\n";?>
	</style>
<?php
}

add_action( 'wp_head', 'okay_customizer_css' );


/* Render infinite posts by using the template-block.php template */
function pocket_render_infinite_posts() {
	while ( have_posts() ) {
		the_post();

		if ( ! get_post_format() ) {
			get_template_part( 'format', 'standard' );
		} else {
			get_template_part( 'format', get_post_format() );
		};
	}
}


/* Pagination */
function okay_page_has_nav() {
	global $wp_query;

	return ( $wp_query->max_num_pages > 1 );
}


/* Excerpt Read More Link */
function okay_new_excerpt_more( $more ) {
	global $post;

	return ' <a class="more-link" href="' . get_permalink( $post->ID ) . '">- ' . __( 'Read More', 'okay' ) . '-</a>';
}

add_filter( 'excerpt_more', 'okay_new_excerpt_more' );


/* Custom Read More */
function okay_readmore() {
	global $post;
	$ismore = @strpos( $post->post_content, '<!--more-->' );
	if ( $ismore !== false ) : the_content( __( '- Read More -', 'okay' ) ); else : the_excerpt( __( '- Read More -', 'okay' ) );
	endif;
}


/* Register Widget Areas */
if ( function_exists( 'register_sidebars' ) )

	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'okay' ),
		'description'   => __( 'Widgets in this area will be shown in the footer.', 'okay' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>'
	) );


/* Custom Comment Output */
function okay_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID() ?>">

	<div class="comment-block" id="comment-<?php comment_ID(); ?>">
		<div class="comment-info">
			<div class="comment-author vcard clearfix">
				<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>

				<div class="comment-meta commentmetadata">
					<?php printf( __( '<cite class="fn">%s</cite>', 'okay' ), get_comment_author_link() ) ?>
					<div style="clear:both;"></div>
					<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __( '%1$s at %2$s', 'okay' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'okay' ), '  ', '' ) ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="comment-text">
			<?php comment_text() ?>
			<p class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</p>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'okay' ) ?></em>
		<?php endif; ?>
	</div>
<?php
}

function okay_cancel_comment_reply_button( $html, $link, $text ) {
	$style  = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';
	$button = '<div id="cancel-comment-reply-link"' . $style . '>';

	return $button . '<i class="icon-remove-sign"></i> </div>';
}

add_action( 'cancel_comment_reply_link', 'okay_cancel_comment_reply_button', 10, 3 );