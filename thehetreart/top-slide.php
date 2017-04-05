<div id="top_slider" >
<?php 

?>
	<div id="container_slider" class="theme-pascal">
    <div id="slider" >
    	 <?php
			$args = array(
							'post_type'	=> 'top-slide',
							'order'		=> 'ASC',
							'tax_query' => array(
												array(
													'taxonomy'	=> 'top-slide-category',
													'field'		=> 'slug',
													'terms' => 'top_slide'
												)
    										)
							
					);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); 
				$url_thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
			?>
            	<a href="<?php echo get_post_meta($post->ID, 'link-slide', true); ?>" target='_parent'><img src="<?php echo $url_thumbnail; ?>" alt=""/></a>
            <?php endwhile;?>

   	</div>
  </div>
</div>
