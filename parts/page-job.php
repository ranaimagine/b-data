<?php
echo '<div class="jobs medium-tbpadding">';
  while ( have_posts() ) : the_post();
  echo '<div class="row">';
    echo '<article id="post-' . get_the_ID() . '" class="'. join( ' ', get_post_class() ) .'">';
      echo '<div class="small-12 columns">';
        the_title('<h1 class="lite"><a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">','</a></h1>');
        the_content();
      echo '</div>';
    echo '</article>';
  echo '</div>';
  endwhile;
  echo '<div class="job-panel">';
    $query = new WP_Query( 'order=desc&post_type=job&post_status=publish&paged='. get_query_var('paged'));
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    echo '<div class="row">';
      echo '<div class="small-12 columns">';
        echo '<div class="white columns jobBox">';
          the_title('<h3><a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">','</a></h3>');
          echo '<p class="time">';
            the_time('F j, Y');
          echo '</p>';
          the_excerpt();
          echo '<p><a class="readmore primary-color" href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">';
            echo "Læs mere her";
          echo '</a></p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
    endwhile;
    echo '<div class="row navigation text-center">';
      echo '<div class="small-12 columns">';
        if (function_exists("pagination")) {
        pagination($query->max_num_pages);
        }
      echo '</div>';
    echo '</div>';
    wp_reset_postdata();
    else :
    echo '<div class="row noposts">';
      echo '<div class="small-12 columns">';
        echo '<div class="columns callout">';
          echo '<p>';
            _e('Ingen ledige stillinger i øjeblikket.','example');
          echo '</p>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
    endif;
  echo '</div>';
echo '</div>';