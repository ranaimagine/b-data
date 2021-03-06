<?php

function disable_wp_emoji_feed_json() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  // Remove feed links

  remove_action('wp_head', 'rsd_link'); // remove really simple discovery
  remove_action('wp_head', 'wp_generator'); // remove wordpress version
  remove_action('wp_head', 'feed_links', 2); // remove rss feed links *** RSS ***
  remove_action('wp_head', 'feed_links_extra', 3); // removes all rss feed links

  remove_action('wp_head', 'index_rel_link'); // removes link to index (home) page
  remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (windows live writer support)

  remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
  #remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

  // Remove wp json
  #remove_action( 'wp_head', 'rest_output_link_wp_head');
  #remove_action( 'wp_head', 'wp_oembed_add_discovery_links');

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emoji_tinymce' );
}
add_action( 'init', 'disable_wp_emoji_feed_json' );

function disable_emoji_tinymce( $plugins ) {
  if ( is_array( $plugins ) ):
    return array_diff( $plugins, array( 'wpemoji' ) );
  else:
    return array();
  endif;
}

