    <!--footer-->
    <div id="footer"> 
      <!--footer_inner-->
      <div id="footer_inner">
        <div class="clearfix"> 
          <!--left_footer-->
          <div id="left_footer">
			<?php
				$myposts = get_posts(
										array(
											'post_type'=>'page',
											'p'=>141, 
										)
									);
				foreach( $myposts as $post ) :	setup_postdata($post);  
			?>
            <h3 id="introduce_footer"><?php the_title(); ?></h3>
            <p class="intro_description"><?php the_content(); ?></p>
			<?php
				endforeach;
			?>
            <!--footer_slider-->
            <div id="footer_slider">
              <ul>
              	 <?php
					$args = array(
							'post_type'	=> 'top-slide',
							'order'		=> 'ASC',
							'tax_query' => array(
												array(
													'taxonomy'	=> 'top-slide-category',
													'field'		=> 'slug',
													'terms' => 'footer_slide'
												)
    										)
							
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					$url_thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
				?>
				<li><img src="<?php echo $url_thumbnail; ?>" /></li>
                <?php endwhile; ?>
              </ul>
              <div id="footerSlider_prev"></div>
              <div id="footerSlider_next"></div>
            </div>
            <!--footer_slider--> 
          </div>
          <!--End left_footer--> 
          <!--right_footer-->
          <div id="right_footer">
            <div class="text_rightFooter">
			<?php
				$info_object = get_page(141);
				$myposts = get_posts(
										array(
											'post_type'=>'page',
											'p'=>169, 
										)
									);
				foreach( $myposts as $post ) :	setup_postdata($post); 
				the_content();
				endforeach;
			?>
            </div>
            <div id="logo_footer"> <a href="#"><img src="<?php bloginfo("template_url"); ?>/images/logo_footer.png" /></a> </div>
            <div id="copyright">Copyright © 2014 by THẾ HỆ TRẺ Co.</div>
          </div>
          <!--End right_footer--> 
        </div>
        <ul class="footer_menu">
			<?php include(TEMPLATEPATH.'/bot-menu.php'); ?>
        </ul>
      </div>
      <!--End footer_inner--> 
    </div>
    <!--End footer--> 
  </div>
  <!--End wrapper_inner--> 
</div>
<!--End wrapper--> 
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/jquery.nivo.slider.pack.js"></script> 
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/init.js"></script> 
</body>
</html>