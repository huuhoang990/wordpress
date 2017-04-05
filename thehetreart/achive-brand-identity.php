<?php 
/*
Template Name: Archives brand identity
*/
get_header();
?>
    <!--content-->
    <div id="content">
      <div class="category_lable">
        <p><?php the_title(); ?></p>
      </div>
      <!--info-->
      <div id="info" class="clearfix"> 
        <!--left_about-->
        <div class="left_about">
          <ul class="leftMenu_about">
 <?php
			$args = array(
						'post_type' =>'brand-identity',
						'post_status' => 'publish',
						'order' => 'ASC'
					);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
		?>
        	<li <?php echo $class ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
          </ul>
        </div>
        <!--End left_about--> 
        <!--right_about-->
        <div class="right_about"> 
          <!--inner_rightAbout-->
          <div class="inner_rightAbout">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts( array( 'post_type' => 'brand-identity', 'posts_per_page' => 5, 'caller_get_posts' => 5, 'paged' => $paged ) );
			?>
			<?php 
				if (have_posts()) :
					while (have_posts()) : the_post();
						$url_thumbnail;
						if ( has_post_thumbnail() ) {
							$url_thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
						}
						else {
							$url_thumbnail =  get_bloginfo( 'stylesheet_directory' ).'/images/achive/profile.jpg';
						}
			?>
			<!--block_achive-->
            <div class="block_achive clearfix">
              <div class="container_imgAchive"><a class="featureAchive_img" href="#"><img src="<?php echo $url_thumbnail; ?>" /></a></div>
              <h3 class="title_achive"><a href="<?php the_permalink();?>"> <?php the_title();?></a></h3>
              <p class="txt_achive"><?php echo get_the_excerpt();?></p>
              <p class="readmore_achive"><a href="<?php the_permalink();?>">Xem thêm...</a></p>
              <div></div>
            </div>
            <!--End block_achive-->

			<?php 
					endwhile; else:
				endif;
				the_posts_pagination( array(
					'screen_reader_text' => ' ', 
    				'prev_text'          => __( 'Trước', '' ),
    				'next_text'          => __( 'Sau', '' )
				));
			?>
            <?php wp_reset_query();?>
            <!--pagination-->
			<!--<ul class="pagination">
            	<li class="prev_pagination"><a href="#">Trước</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li class="next_pagination"><a href="#">Sau</a></li>
            </ul>--><!--End pagination-->
          </div>
          <!--End inner_rightAbout--> 
        </div>
        <!--End right_about--> 
      </div>
      <!--End info--> 
    </div>
    <!--End content--> 
<?php get_footer(); ?>