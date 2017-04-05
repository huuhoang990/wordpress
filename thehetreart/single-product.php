<?php get_header(); ?>
<!--content-->
<div id="content">
  <div class="category_lable">
    <p>Hệ thống nhận diện thương hiệu</p>
  </div>
  <!--info-->
  <div id="info" class="clearfix"> 
    <!--left_about-->
    <div class="left_about">
      <ul class="leftMenu_about">
		<?php
			$current_id = get_the_ID();
			$args = array(
						'post_type' =>'product',
						'post_status' => 'publish',
						'order' => 'ASC'
					);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
				$id_querry = $post->ID;
				$class = '';
				if($id_querry == $current_id){
					$class = 'class="current"';
				}
		?>
        	<li <?php echo $class ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
      </ul>
    </div>
    <!--End left_about--> 
    <!--right_about-->
    <div class="right_about">
      <div class="inner_rightAbout">
		<?php while ( have_posts() ) : the_post(); ?>
       		<h3 class="title_about"><?php the_title(); ?></h3>
            <div class="content_about">
            	<?php the_content();?>
            </div>
		<?php endwhile;?>
      </div>
    </div>
    <!--End right_about--> 
  </div>
  <!--End info--> 
</div>
<!--End content-->
<?php get_footer(); ?>