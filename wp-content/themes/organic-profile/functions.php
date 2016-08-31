<?php

/*-----------------------------------------------------------------------------------------------------//
/*	Theme Setup
/*-----------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'profile_setup' ) ) :

function profile_setup() {

	// Make theme available for translation
	load_theme_textdomain( 'organic-profile', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Add title tag
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'profile-featured-slide', 880, 496, true ); // Featured Slides
	add_image_size( 'profile-featured-square', 640, 640, true ); // Square Featured Images
	add_image_size( 'profile-featured-large', 2400, 1600 ); // Large Featured Image
	add_image_size( 'profile-featured-medium', 1800, 1200 ); // Medium Featured Image
	add_image_size( 'profile-featured-small', 980, 980 ); // Small Featured Image

	// Create Menus
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'organic-profile' ),
		'social-menu' => __( 'Social Menu', 'organic-profile' ),
	));
	
	// Custom Header
	$defaults = array(
		'width'                 => 1800,
		'height'                => 800,
		'default-image'			=> get_template_directory_uri() . '/images/background.jpg',
		'flex-height'           => true,
		'flex-width'            => true,
		'header-text'           => false,
		'uploads'               => true,
	);
	add_theme_support( 'custom-header', $defaults );
	
	// Custom Background
	$defaults = array(
		'default-color'      => '222222',
		'default-repeat'     => 'no-repeat',
		'default-position-x' => 'center',
		'default-attachment' => 'fixed',
	);
	add_theme_support( 'custom-background', $defaults );
}
endif; // profile_setup
add_action( 'after_setup_theme', 'profile_setup' );

/*-----------------------------------------------------------------------------------------------------//
	Theme Updater
-------------------------------------------------------------------------------------------------------*/

function profile_theme_updater() {
	require( get_template_directory() . '/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'profile_theme_updater' );

/*-----------------------------------------------------------------------------------------------------//	
	Category ID to Name		       	     	 
-------------------------------------------------------------------------------------------------------*/

function profile_cat_id_to_name( $id ) {
	$cat = get_category( $id );
	if ( is_wp_error( $cat ) )
		return false;
	return $cat->cat_name;
}

/*-----------------------------------------------------------------------------------------------------//	
	Register Scripts and Styles		       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists('ot_enqueue_scripts') ) {
	function ot_enqueue_scripts() {
	
		// Enqueue Styles
		wp_enqueue_style( 'profile-style', get_stylesheet_uri() );
		wp_enqueue_style( 'profile-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', '', '1.0' );
		
		// Resgister Scripts		
		wp_register_script( 'profile-fitvids', get_template_directory_uri() . '/js/jquery.fitVids.js', array( 'jquery' ), '20131004' );
		wp_register_script( 'profile-hover', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '20131004' );
		wp_register_script( 'profile-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery', 'profile-hover' ), '20131004' );
		wp_register_script( 'profile-isotope', get_template_directory_uri() . '/js/jquery.isotope.js', array( 'jquery' ), '20130729' );
	
		// Enqueue Scripts
		wp_enqueue_script( 'profile-html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
		//wp_enqueue_script( 'profile-twitter', get_template_directory_uri() . '/js/twitterFetcher.min.js' );
		wp_enqueue_script( 'profile-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'profile-superfish', 'profile-fitvids', 'profile-isotope', 'jquery-masonry' ), '20131004', true );
		wp_enqueue_script( 'profile-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20131004', true );
		
		// Load Flexslider on front page and slideshow page template
		if( is_home() || is_front_page() || is_page_template('template-slideshow.php') ) {
			wp_enqueue_script( 'profile-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20131004' );
		}
		
		// Load Twitter on home page
		if( is_home() || is_front_page() ) {
			wp_enqueue_script( 'profile-twitter', get_template_directory_uri() . '/js/twitter.min.js', array( 'jquery' ), '20131004' );
		}
	
		// Load single scripts only on single pages
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action('wp_enqueue_scripts', 'ot_enqueue_scripts');
}

/*-----------------------------------------------------------------------------------------------------//	
	WooCommerce Integration			       	     	 
-------------------------------------------------------------------------------------------------------*/

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
    add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>  
	<div class="container">
		<div class="row">
			<div class="eight columns">
 				<div class="postarea">
    <?php
}

function mytheme_close_woocommerce_content_wrappers() {
	?>
	    		</div> <!-- /postarea -->
	    	</div> <!-- /columns -->
	 
	        <div class="four columns">
	        	<?php get_sidebar(); ?>
	        </div>
	        
	 	</div> <!-- /row -->
    </div> <!-- /container --> 
    <?php
}

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

// WooCommerce thumbnail image sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'woo_install_theme', 1);
function woo_install_theme() {
 
update_option( 'woocommerce_thumbnail_image_width', '192' );
update_option( 'woocommerce_thumbnail_image_height', '192' );
update_option( 'woocommerce_single_image_width', '600' );
update_option( 'woocommerce_single_image_height', '600' );
update_option( 'woocommerce_catalog_image_width', '140' );
update_option( 'woocommerce_catalog_image_height', '140' );
}

// WooCommerce default product columns
function loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'loop_columns');

// WooCommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*-----------------------------------------------------------------------------------------------------//	
	Register Sidebars		       	     	 
-------------------------------------------------------------------------------------------------------*/

function profile_widgets_init() {
	register_sidebar(array(
		'name'=> __( "Default Sidebar", 'organic-profile' ),
		'id' => 'right-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6 class="title">',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Blog Sidebar", 'organic-profile' ),
		'id' => 'blog-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6 class="title">',
		'after_title'=>'</h6>'
	));
}
add_action( 'widgets_init', 'profile_widgets_init' );
	
/*-----------------------------------------------------------------------------------------------------//	
	Comments Function		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'organicthemes_comment' ) ) :
function organicthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'organic-profile' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'organic-profile' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'organic-profile' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s', 'organic-profile' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'organic-profile' ); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'organic-profile' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'organic-profile' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for organicthemes_comment()

/*-----------------------------------------------------------------------------------*/
/*	Pagination Function
/*-----------------------------------------------------------------------------------*/

function get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'prev_text' => __('&laquo;', 'organic-profile'),
		'next_text' => __('&raquo;', 'organic-profile'),
		'total' => $wp_query->max_num_pages
	) );
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Page Links
/*-----------------------------------------------------------------------------------*/

function wp_link_pages_args_prevnext_add($args) {
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number') 
        return $args; 

    $args['next_or_number'] = 'number'; // Keep numbering for the main part
    if (!$more)
        return $args;

    if($page-1) // There is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';

    if ($page<$numpages) // There is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after'];

    return $args;
}

add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');

/*----------------------------------------------------------------------------------------------------//
/*	Content Width
/*----------------------------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Adjust content_width value based on the presence of widgets
 */
function profile_content_width() {
	if ( ! is_active_sidebar( 'right-sidebar' )|| is_active_sidebar( 'blog-sidebar' ) ) {
		global $content_width;
		$content_width = 1024;
	}
}
add_action( 'template_redirect', 'profile_content_width' );

/*-----------------------------------------------------------------------------------------------------//	
	Featured Video Meta Box		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "admin_init_featurevid");
add_action('save_post', 'save_featurevid');

function admin_init_featurevid(){
	add_meta_box("featurevid-meta", __("Featured Video Embed Code", 'organic-profile'), "meta_options_featurevid", "post", "normal", "high");
}

function meta_options_featurevid(){
	global $post;
	$custom = get_post_custom($post->ID);
	$featurevid = $custom["featurevid"][0];

	echo '<textarea name="featurevid" cols="60" rows="4" style="width:97.6%" />'.$featurevid.'</textarea>';
}

function save_featurevid($post_id){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if ( isset($_POST["featurevid"]) ) { 
		update_post_meta($post->ID, "featurevid", $_POST["featurevid"]); 
	}
}

/*-----------------------------------------------------------------------------------------------------//
	Add Stylesheet To Visual Editor
-------------------------------------------------------------------------------------------------------*/
	
add_action( 'init', 'profile_add_editor_styles' );
/**
* Apply theme's stylesheet to the visual editor.
*
* @uses add_editor_style() Links a stylesheet to visual editor
* @uses get_stylesheet_uri() Returns URI of theme stylesheet
*/
function profile_add_editor_styles() {
	add_editor_style( 'css/style-editor.css' );
}

/*-----------------------------------------------------------------------------------------------------//	
	Add Home Link To Custom Menu	       	     	 
-------------------------------------------------------------------------------------------------------*/

function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

/*-----------------------------------------------------------------------------------------------------//	
	Strip inline width and height attributes from WP generated images		       	     	 
-------------------------------------------------------------------------------------------------------*/
 
function remove_thumbnail_dimensions( $html ) { 
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); 
	return $html; 
	}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/*-----------------------------------------------------------------------------------*/
/*	Includes
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/includes/customizer.php' );
require_once( get_template_directory() . '/includes/typefaces.php' );
include_once( get_template_directory() . '/organic-shortcodes/organic-shortcodes.php' );
