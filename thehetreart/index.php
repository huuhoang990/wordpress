<?php get_header(); ?>
<!--content-->

<div id="content"> 
  <!--info-->
  <div id="info" class="clearfix"> 
    <!--left_info-->
    <div id="left_info"> 
      <!--inner_leftInfo-->
      <div id="inner_leftInfo">
        <h1 class="title_leftInfo">
        	<a href="
				<?php
				$infoposts = get_posts(
										array(
											'post_type'=>'page',
											'p'=>131, 
										)
									);
				foreach( $infoposts as $post ) :	setup_postdata($post);  
					the_permalink();
				endforeach;
				?>
            ">
            <?php
			if($_GET['lang']=='en'){
				echo 'Do you know?';
			}
			else {
				echo 'BẠN CẦN BIẾT';
			}	 
			?>
            </a>
        </h1>
        <!--h_slider-->
        <div id="h_slider">
          <ul>
            <?php
						$args = array(
							'post_type' =>'news',
							'order' => 'ASC',
							'meta_key' => 'index-slide',
		    				'meta_value' => 'true'
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); 
						$url_thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
			?>
            <li>
              <p class="text_leftInfo clearfix">
				<img src="<?php echo $url_thumbnail; ?>" width="150" height="auto" class="img_leftInfo"/>
                <a class="description_leftInfo" href="<?php the_permalink();?>">
                <?php the_title();?>
                </a>
                <?php echo get_the_excerpt();?>
                <br />
                <a href="<?php the_permalink();?>" class="leftInfo_readmore"><b>Xem thêm</b></a> </p>
            </li>
            <?php endwhile;?>
          </ul>
        </div>
        <!--End h_slider--> 
      </div>
      <!--End inner_leftInfo--> 
    </div>
    <!--End left_info--> 
    <!--right_info-->
    <div id="right_info"> <img src="<?php bloginfo("template_url"); ?>/images/process_order.jpg" /> </div>
    <!--End right_info--> 
  </div>
  <!--End info--> 
</div>
<!--End content-->
<?php get_footer(); ?>
