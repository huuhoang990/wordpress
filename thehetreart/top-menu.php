<?php
$menu1 = "DỊCH VỤ<br />THIẾT KẾ";
$menu2 = "IN ẤN<br>SẢN PHẨM";
$menu3 = "TIN TỨC";

if($_GET['lang']=='en'){
	$menu1 = "DESIGN<br />SERVICES";
	$menu2 = "PRINTING<br />PRODUCTS";
	$menu3 = "NEWS";
}
?>
<div id="top_nav">
        <ul>
          <li> <a href="#"><?php echo $menu1; ?></a> 
            <!--submenu-->
            <ul class="submenu left_471">
              <li class="clearfix"> 
                <!--left_submenu-->
                <ul class="left_submenu">
					<?php
				  	$menu_name = 'top-menu1';
					$locations = get_nav_menu_locations();
					$menu_id = $locations[$menu_name] ;
					$menu = wp_get_nav_menu_object($menu_id);
					$menu_items = wp_get_nav_menu_items($menu->term_id);
					for($i = 0; $i < sizeof($menu_items); $i++) {
						$id_item = $menu_items[$i]->object_id;
						$post_object = get_page($id_item);
						$image_uri = wp_get_attachment_image_src( get_post_thumbnail_id( $id_item ), 'single-post-thumbnail' );
					?>
                   	<li><img class="img_contentSub" src="<?php echo $image_uri[0]; ?>" />
                    <h3 class="title_contentSub"><?php echo $post_object->post_title; ?></h3>
                    <hr />
                    <p class="txt_contentSub"><?php echo $post_object->post_content;?></p>
                  	</li>
                    <?php
					}
					?>
                </ul>
                <!--End left_submenu--> 
                <!--left_submenu-->
                <ul class="right_submenu">
						<?php
        				if ( function_exists( 'wp_nav_menu' ) ){
          					wp_nav_menu( array( 
          						'theme_location' => 'top-menu1',
          						'container' => '',
          						'menu_class' => '' , 
           						'items_wrap' => '%3$s'
          					));
        				}
    					?>
                </ul>
                <!--End left_submenu--> 
                
              </li>
            </ul>
            <!--End submenu--> 
          </li>
          <li><a href="#"><?php echo $menu2; ?></a> 
            <!--submenu-->
            <ul class="submenu left_592">
              <li class="clearfix"> 
                <!--left_submenu-->
                <ul class="left_submenu">
					<?php
				  	$menu_name = 'top-menu2';
					$locations = get_nav_menu_locations();
					$menu_id = $locations[$menu_name] ;
					$menu = wp_get_nav_menu_object($menu_id);
					$menu_items = wp_get_nav_menu_items($menu->term_id);
					for($i = 0; $i < sizeof($menu_items); $i++) {
						$id_item = $menu_items[$i]->object_id;
						$post_object = get_page($id_item);
						$image_uri = wp_get_attachment_image_src( get_post_thumbnail_id( $id_item ), 'single-post-thumbnail' );
					?>
                   	<li><img class="img_contentSub" src="<?php echo $image_uri[0]; ?>" />
                    <h3 class="title_contentSub"><?php echo $post_object->post_title; ?></h3>
                    <hr />
                    <p class="txt_contentSub"><?php echo $post_object->post_content;?></p>
                  	</li>
                    <?php
					}
					?>
                </ul>
                <!--End left_submenu--> 
                <!--left_submenu-->
                <ul class="right_submenu">
						<?php
        				if ( function_exists( 'wp_nav_menu' ) ){
          					wp_nav_menu( array( 
          						'theme_location' => 'top-menu2',
          						'container' => '',
          						'menu_class' => '' , 
           						'items_wrap' => '%3$s'
          					));
        				}
    					?>
                </ul>
                <!--End left_submenu--> 
                
              </li>
            </ul>
            <!--End submenu--> 
          </li>
          <li>
          	<a href="#"><?php echo $menu3; ?></a>
            <div class="submenu2">
				<ul>
						<?php
        				if ( function_exists( 'wp_nav_menu' ) ){
          					wp_nav_menu( array( 
          						'theme_location' => 'top-menu3',
          						'container' => '',
          						'menu_class' => '' , 
           						'items_wrap' => '%3$s'
          					));
        				}
    					?>
                </ul>
            </div>
          </li>
        </ul>
      </div>