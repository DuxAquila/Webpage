<?php $options = get_option( 'startup_options' ); ?>
<footer class="entry-footer">
<?php if ( $options['share'] && is_single() ) { echo '<div id="share"><div data-layout="button_count" class="fb-like"></div><a href="//twitter.com/share" class="twitter-share-button">Tweet</a><div data-size="medium" class="g-plusone"></div></div>'; } ?>
<span class="cat-links"><?php _e( 'Categories: ', 'startup' ); ?><?php the_category( ', ' ); ?></span>
<span class="tag-links"><?php the_tags(); ?></span>
<?php if ( comments_open() ) { 
echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf( __( 'Comments', 'startup' ) ) . '</a></span>';
} ?>
</footer> 