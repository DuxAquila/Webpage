<?php $options = get_option( 'startup_options' ); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
<?php
if ( $options['social'] ) {
echo '<div id="social">';
if ( $options['googleurl']!="" )
echo '<a href="' . esc_url( $options['googleurl'] ) . '" id="social-google"><img src="' . get_template_directory_uri() . '/images/social/google.png" alt="Google+" /></a>';
if ( $options['linkedinurl']!="" )
echo '<a href="' . esc_url( $options['linkedinurl'] ) . '" id="social-linkedin"><img src="' . get_template_directory_uri() . '/images/social/linkedin.png" alt="LinkedIn" /></a>';
if ( $options['twitterurl']!="" )
echo '<a href="' . esc_url( $options['twitterurl'] ) . '" id="social-twitter"><img src="' . get_template_directory_uri() . '/images/social/twitter.png" alt="Twitter" /></a>';
if ( $options['facebookurl']!="" )
echo '<a href="' . esc_url( $options['facebookurl'] ) . '" id="social-facebook"><img src="' . get_template_directory_uri() . '/images/social/facebook.png" alt="Facebook" /></a>';
echo '</div>'; }
?>
<section id="branding">
<div id="site-title">
<?php
if ( !is_singular() ) { echo '<h1>'; }
echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home">';
if ( $options['logo']!="" )
echo '<img src="' . esc_url( $options['logo'] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" id="logo" />';
else
echo esc_html( bloginfo( 'name' ) );
echo '</a>';
if ( !is_singular() ) { echo '</h1>'; }
?>
</div>
<?php if ( $options['description'] ) { echo '<div id="site-description">' . esc_html( get_bloginfo( 'description' ) ) . '</div>'; } ?>
</section>
<nav id="menu" role="navigation">
<?php if ( $options['search'] ) { get_search_form(); } ?>
<label class="toggle" for="toggle">&#9776; Menu</label>
<input id="toggle" class="toggle" type="checkbox" />
<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
<script type="text/javascript">jQuery("ul").parent("li").addClass("parent");</script>
</nav>
</header>
<?php if ( $options['crumbs'] ) { startup_breadcrumbs(); } ?>
<?php if ( $options['slider'] ) { echo show_nivo_slider(); } ?>
<?php if ( $options['twitter'] ) {
echo '<div id="twitter-feed">';
echo '<a class="twitter-timeline" data-theme="light" data-link-color="#0099ff" data-chrome="noheader nofooter noborders noscrollbar transparent" data-tweet-limit="1" data-show-replies="false" data-screen-name="' . sanitize_text_field( $options["twitname"] ) . '" href="https://twitter.com/' . sanitize_text_field( $options["twitname"] ) . '" data-widget-id="347461587419926528">Tweets by @' . sanitize_text_field( $options["twitname"] ) . '</a>';
echo '</div>'; } ?>
<div id="container">