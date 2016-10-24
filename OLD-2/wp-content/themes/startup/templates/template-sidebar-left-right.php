<?php /* Template Name: Sidebar Left and Right */ ?>
<?php get_header(); ?>
<aside id="lsidebar-sidebar" role="complementary">
<?php if ( is_active_sidebar( 'lsidebar-widget-area' ) ) : ?>
<div id="lsidebar" class="widget-area">
<ul class="xoxo">
<?php dynamic_sidebar( 'lsidebar-widget-area' ); ?>
</ul>
<div class="clear"></div>
</div>
<?php endif; ?>
</aside>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
</header>
<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>
</article>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
</section>
<aside id="rsidebar-sidebar" role="complementary">
<?php if ( is_active_sidebar( 'rsidebar-widget-area' ) ) : ?>
<div id="rsidebar" class="widget-area">
<ul class="xoxo">
<?php dynamic_sidebar( 'rsidebar-widget-area' ); ?>
</ul>
<div class="clear"></div>
</div>
<?php endif; ?>
</aside>
<?php get_footer(); ?>