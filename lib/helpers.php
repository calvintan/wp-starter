<?php
if(!function_exists('_themename_post_meta')) {
  function _themename_post_meta() {  
    /* translators: %s: Post Date */
    printf(
      esc_html__( 'Posted on %s', '_themename' ), 
      '<a href="' . esc_url(get_permalink( )) . '"><time datetime="' . esc_attr(get_the_date('c')) . '">' .  esc_html(get_the_date()) . '</time></a>'
    );
    /* translators: %s: Post Author */
    printf(
      esc_html__(' by %s', '_themename'),
      esc_html(get_the_author())
    );
  }
}

function _themename_readmore_link() {
  echo '<a class="c-post__readmore" href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute(['echo' => false]) . '">';
  /* translators: %s: Post Title */
  printf(
    wp_kses(
      __('Read More', '_themename'),
      [
        'span' => [
          'class' => []
        ]
      ]
    ),
    get_the_title()
  );
  echo '</a>';
}

// Page Slug Body Class
function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}

add_filter( 'body_class', 'add_slug_body_class' );

?>