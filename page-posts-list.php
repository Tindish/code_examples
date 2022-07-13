<?php
/*
 * Template Name: Posts
 * Template Post Type: page
 */

	get_header();

	$featured_posts = array();
	$post_slug = $post->post_name;


	if ($post_slug == 'news') {

		// Get excluded categories
		$excluded_cats = array(
			1,   // Performance Management
			58,  // Workforce Communication
			59,  // Workforce Engagement and Onboarding
			152, // Engagement & Culture
			181, // Integrations
			227  // HR Operations
		);
		// will include 218 Press Release only

		// For now just get the 3 most recent posts in the allowed categories
		$query = new WP_Query(array(
			'post_type'        =>'post',
			'post_status'      =>'publish',
			'posts_per_page'   => 3,
			'category__not_in' => $excluded_cats,
			'fields'           => 'ids'
		));
		$featured_posts = $query->posts;

	} else {

		// Get excluded categories
		$excluded_cats = array(
			218,219,220
		);

		// Get the featured posts
		for ($i=0; $i < 3; $i++) { 
			$featured_id = get_field('featured_'.$i.'', 'options');
			array_push($featured_posts, $featured_id);
		}
	}


?>

<!-- Title Area -->
<div class="container container-full">

	<div class="post-list-header">

		<?php include get_template_directory().'/includes/featured-image.php'; ?>
		<div class="cover-circles">
			<div></div>
			<div></div>
			<div></div>
		</div>

		<header>
			<div class="container container-medium">
				<h1 class="post-list-title mx-md-4 mb-0"><?php the_title(); ?></h1>
				<p><?php the_excerpt(); ?></p>
			</div>
		</header>

	</div>

</div>



<section class="post-list-featured light">
	<div class="container container-xlarge">
		<div class="gap-1"></div>
		<h5 class="post-list-featured-title">Featured:</h5>
		<div class="row">

			<?php

				// Get the three newest blog posts
				$query = new WP_Query(array(
					'post_type' =>'post',
					'post__in'  => $featured_posts,
					'orderby'   =>'post__in'
				));

				$loop = 0;
				if ($query->have_posts()) : while($query->have_posts()) : $query->the_post();

				// Check Yoast primary category
				$term_list = wp_get_post_terms($post->ID, 'category', ['fields' => 'all']);
				foreach($term_list as $term) {
					if( get_post_meta($post->ID, '_yoast_wpseo_primary_category',true) == $term->term_id ) {
						$cat_name = $term->name;
						$cat_slug = $term->slug;
					}
				}

				// Is a header image supplied?
				$header_image = get_field('header_image') ? get_field('header_image') : null;

			?>

			<div class="<?php echo $loop==0 ? 'col-lg-6' : 'col-md-6 col-lg-3';?>">
				<!-- Article Start  -->
				<article id="post-<?php the_ID(); ?>" class="entry-link featured <?php echo $loop==0 ? 'featured-large' : '';?> mb-5">

					<a href="<?php the_permalink(); ?>">
						<div class="media-holder <?php echo $i==0 ? ' media-md-219' : '';?>">

							<?php if ($header_image) :
								$alt = $header_image['alt'];
								// Thumbnail size attributes.
								$size   = 'post_thumbnail';
								$thumb  = $header_image['sizes'][$size];
								$width  = $header_image['sizes'][$size . '-width'];
								$height = $header_image['sizes'][$size . '-height'];
							?>
								<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
							<?php else : include get_template_directory().'/includes/featured-image-thumbnail.php'; endif; ?>
						</div>
						<div class="entry-link-content">
							<h6><?php echo $cat_name; ?></h6>
							<h5><?php the_title(); ?></h5>
							<p><?php echo $loop==0 ? excerpt(40) : excerpt(20); ?></p>
						</div>
						<div class="entry-link-content-btn">
							<div class="btn__link">View</div>
						</div>

					
					</a>
				</article>
			</div>

			<?php
					$loop++;
					endwhile;
				endif;
				wp_reset_postdata();
			?>

		</div>
	</div>
</section>





<div class="container container-xlarge post-list-container">

	<aside class="post-list-sidebar">
		
		<h3 class="show-hide mt-3 mb-0">Filters</h3>

		<div id="post-list-filter">

			<?php get_search_form(); ?>

			<div class="divider-2"></div>

			<h4>Category:</h4>
			<?php
				$cats = get_categories('hide_empty=0');
				if (!empty($cats)) {
					echo '<ul>';
					foreach ($cats as $term) {
						$id = $term->term_id;
						$url = get_category_link($term);
						if (!in_array($id, $excluded_cats)) {
							echo '<li><a href="'.esc_url($url).'">'.esc_html( $term->name ).'</a></li>';
						}

					}
					echo '</ul>';
				}
			?>

			<div class="divider-2"></div>
			<h4>Connect:</h4>

			<div class="icons-contact animate-chain animate-flyin-down">
				<?php include get_template_directory().'/includes/icons-socials.php'; ?>
			</div>

		</div>

		<div class="divider-1"></div>

	</aside>

	<div class="post-list-posts">

		<div class="post-list">
			<div class="row">

			<?php

				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				// Get all blog posts
				$wp_query = new WP_Query(array(
					'post_type'        =>'post',
					'post_status'      =>'publish',
					'paged'            => $paged,
					'posts_per_page'   => 12,
					'post__not_in'     => $featured_posts,
					'category__not_in' => $excluded_cats
				));


				if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();

					// Check Yoast primary category
					$term_list = wp_get_post_terms($post->ID, 'category', ['fields' => 'all']);
					foreach($term_list as $term) {
						if( get_post_meta($post->ID, '_yoast_wpseo_primary_category',true) == $term->term_id ) {
							$cat_name = $term->name;
							$cat_slug = $term->slug;
						}
					}

					// Is a header image supplied?
					$header_image = get_field('header_image') ? get_field('header_image') : null;

				?>

				<div class=" col-md-6 col-lg-6 col-xl-4">


					<!-- Article Start  -->
					<article id="post-<?php the_ID(); ?>" class="entry-link mb-5">

						<a href="<?php the_permalink(); ?>">
							<div class="media-holder media-169">
								<?php if ($header_image) :
									$alt = $header_image['alt'];
									// Thumbnail size attributes.
									$size   = 'post_thumbnail';
									$thumb  = $header_image['sizes'][$size];
									$width  = $header_image['sizes'][$size . '-width'];
									$height = $header_image['sizes'][$size . '-height'];
								?>
									<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
								<?php else : include get_template_directory().'/includes/featured-image-thumbnail.php'; endif; ?>
							</div>
							<div class="entry-link-content">
								<h6><?php echo $cat_name; ?></h6>
								<h5><?php the_title(); ?></h5>
								<p><?php echo excerpt(20); ?></p>
							</div>
							<div class="entry-link-content-btn">
								<div class="btn__link">View</div>
							</div>

						</a>
					</article>
				</div>

			<?php
					endwhile;
				endif;
				wp_reset_postdata();
			?>

			<nav class="pagination"><?php pagination_bar(); ?></nav>

			</div>
		</div>

	</div>

</div>


<?php
	get_footer();

