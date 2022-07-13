<div class="list-logo">

  <?php // Get all posts of type 

  global $post;
  $args = array(
    'numberposts' => -1,
    'posts_per_page'	=> -1,
    'post_type'  => $type,
  );

  $posts = get_posts($args);
  if($posts):
    foreach($posts as $post): setup_postdata($post); // Loop through the posts
      
      $link     = null;
      $name     = get_the_title();
      $internal = get_field('internal'); //optional
      $external = get_field('external'); //optional

      $width = get_field('width');
      $height = get_field('height');

      $colour=='dark' ? $image = get_field('image_white') : $image = get_field('image'); // Check if dark variable passed and if so pull the white images, if not, pull the full colour ones
      get_field('tab') ? $tab = ' target="_blank"': $tab = '';

      if ($internal) {
        $link = $internal;
      } elseif ($external) {
        $link = $external;
      }
      
      if ($links=='no') {
        echo '<a href=""><img src="'.$image['url'].'" alt="'.$image['alt'].'" width="'.$width.'" height="'.$height.'"></a>';
      } else {
        echo empty($link) ? '' : '<a href="'.$link.'" title="Learn more about '.$name.'" '.$tab.'>';
        echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" width="'.$width.'" height="'.$height.'">';
        echo empty($link) ? '' : '</a>';
      }


    endforeach;
    wp_reset_query();
    wp_reset_postdata();
  endif;

?>

</div>
