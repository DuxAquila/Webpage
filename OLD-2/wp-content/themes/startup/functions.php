<?php
add_action( 'after_setup_theme', 'startup_setup' );
function startup_setup()
{
load_theme_textdomain( 'startup', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'startup' ) )
);
}
require_once ( get_template_directory() . '/setup/options.php' );
add_action( 'wp_enqueue_scripts', 'startup_load_scripts' );
function startup_load_scripts()
{
wp_enqueue_script( 'jquery' );
wp_register_script( 'twitter', 'https://platform.twitter.com/widgets.js' );
wp_enqueue_script( 'twitter' );
wp_register_script( 'gplus', 'https://apis.google.com/js/plusone.js' );
wp_enqueue_script( 'gplus' );
wp_register_script( 'startup-videos', get_template_directory_uri() . '/scripts/videos.js' );
wp_enqueue_script( 'startup-videos' );
}
function startup_enqueue_admin_scripts()
{
global $startup_theme_page;
if ( $startup_theme_page != get_current_screen()->id ) { return; }
wp_enqueue_script( 'startup-admin-script', get_template_directory_uri() . '/scripts/admin.js', array( 'jquery', 'media-upload', 'thickbox' ) );
wp_enqueue_script( 'startup-admin-color', get_template_directory_uri() . '/scripts/color-picker/color.js' );
wp_enqueue_style( 'startup-admin-style', get_template_directory_uri() . '/scripts/admin.css' );
wp_enqueue_style( 'thickbox' );
}
add_action( 'wp_enqueue_scripts', 'startup_load_styles' );
function startup_load_styles()
{
wp_enqueue_style( 'startup-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300' );
$options = get_option( 'startup_options' );
if ( $options['gfont1'] ){ wp_enqueue_style( 'startup-gfont1', 'https://fonts.googleapis.com/css?family=' . sanitize_text_field( $options['gfont1'] ) ); }
}
add_action( 'wp_head', 'startup_print_custom_styles' );
function startup_print_custom_styles()
{
if ( !is_admin() ) {
$options = get_option( 'startup_options' );
if ( false != $options['customstyles'] ) { 
$custom_css = '<style type="text/css">';
$custom_css .= 'body{';
if ( '' != $options['textcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['textcolor'] ) . ''; }
$custom_css .= '}';
if ( '' != $options['linkcolor'] ) { $custom_css .= 'a{color:#' . sanitize_text_field( $options['linkcolor'] ) . '}'; }
if ( '' != $options['hovercolor'] ) { $custom_css .= 'a:hover{color:#' . sanitize_text_field( $options['hovercolor'] ) . '}'; }
$custom_css .= '.entry-content p{';
if ( '' != $options['pfont'] ) { $custom_css .= 'font-family:' . sanitize_text_field( $options['pfont'] ) . ';'; }
if ( '' != $options['psize'] ) { $custom_css .= 'font-size:' . sanitize_text_field( $options['psize'] ) . 'px;'; }
if ( '' != $options['pcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['pcolor'] ) . ''; }
$custom_css .= '}';
$custom_css .= '.entry-content a{';
if ( '' != $options['plfont'] ) { $custom_css .= 'font-family:' . sanitize_text_field( $options['plfont'] ) . ';'; }
if ( '' != $options['plsize'] ) { $custom_css .= 'font-size:' . sanitize_text_field( $options['plsize'] ) . 'px;'; }
if ( '' != $options['plcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['plcolor'] ) . ''; }
$custom_css .= '}';
$custom_css .= 'h1, h2, h3, h4, h5, h6{';
if ( '' != $options['hfont'] ) { $custom_css .= 'font-family:' . sanitize_text_field( $options['hfont'] ) . ';'; }
if ( '' != $options['hcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['hcolor'] ) . ''; }
$custom_css .= '}';
$custom_css .= 'h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{';
if ( '' != $options['hlcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['hlcolor'] ) . ''; }
$custom_css .= '}';
if ( '' != $options['navbg'] ) { $custom_css .= '#menu{background-color:#' . sanitize_text_field( $options['navbg'] ) . '}'; }
if ( '' != $options['navtrans'] ) { $custom_css .= '#menu li ul{opacity:' . sanitize_text_field( $options['navtrans'] ) . '}'; }
$custom_css .= '</style>';
echo $custom_css; }
}
}
add_action( 'wp_head', 'startup_print_custom_scripts', 99 );
function startup_print_custom_scripts()
{
if ( !is_admin() ) {
$options = get_option( 'startup_options' );
?>
<script type="text/javascript">
jQuery(document).ready(function($){
$("#wrapper").vids();
});
</script>
<?php
}
}
add_action( 'comment_form_before', 'startup_enqueue_comment_reply_script' );
function startup_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'startup_title' );
function startup_title( $title )
{
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'startup_filter_wp_title' );
function startup_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
function startup_breadcrumbs()
{
if ( !is_home() ) {
echo '<div id="breadcrumbs"><a href="' . home_url() . '/">' . __( 'Home', 'startup' ) . '</a> &rarr; ';
if ( is_category() || is_single() ) {
the_category( ', ' );
if ( is_single() ) {
echo " &rarr; ";
the_title();
}
} 
elseif ( is_page() ) { the_title(); }
elseif ( is_tag() ) { _e( 'Tag Page for ', 'startup' ); single_tag_title(); }
elseif ( is_day() ) { _e( 'Archives for ', 'startup' ); the_time( 'F jS, Y' ); }
elseif ( is_month() ) { _e( 'Archives for ', 'startup' ); the_time( 'F, Y' ); }
elseif ( is_year() ) { _e( 'Archives for ', 'startup' ); the_time( 'Y' ); }
elseif ( is_author() ) { _e( 'Author Archives', 'startup' ); }
elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) { _e( 'Blog Archives', 'startup' ); }
elseif ( is_search() ) { _e( 'Search Results', 'startup' ); }
elseif ( is_404() ) { _e( 'Page Not Found', 'startup' ); }
echo '</div>';
}
}
add_action( 'widgets_init', 'startup_widgets_init' );
function startup_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'startup' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Left Sidebar Widget Area', 'startup' ),
'id' => 'lsidebar-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Right Sidebar Widget Area', 'startup' ),
'id' => 'rsidebar-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function startup_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'startup_comments_number' );
function startup_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}