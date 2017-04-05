<?php 
/*
Template Name: Order
*/
get_header();
?>
    <!--content-->
    <div id="content">
      <div class="category_lable">
        <p>QUI TRÌNH ĐẶT HÀNG ONLINE</p>
      </div>
      <!--info-->
      <div id="info" class="clearfix">
      	 <!--order-->
		<div id="order">
        	<ul id="list_order" class="clearfix">
            	<li class="bg_listOrder">
                	<div id="number1" class="order_number"></div>
              	</li>
                <li class="bg_listOrder">
                	<div id="number2" class="order_number"></div>
              	</li>
                <li class="bg_listOrder">
                	<div id="number3" class="order_number"></div>
              	</li>
                <li class="bg_listOrder">
                	<div id="number4" class="order_number"></div>
              	</li>
                <li class="bg_listOrder">
                	<div id="number5" class="order_number"></div>
              	</li>
                <li>
                	<div id="number6" class="order_number"></div>
              	</li>
            </ul>
			<ul id="list_contentOrder">
				<?php if(have_posts()): the_post(); ?>
				<li class="active_contentOrder"><?php echo get_post_meta($post->ID, 'step1', true); ?></li>
                <li><?php echo get_post_meta($post->ID, 'step2', true); ?></li>
                <li><?php echo get_post_meta($post->ID, 'step3', true); ?></li>
                <li><?php echo get_post_meta($post->ID, 'step4', true); ?></li>
                <li><?php echo get_post_meta($post->ID, 'step5', true); ?></li>
                <li><?php echo get_post_meta($post->ID, 'step6', true); ?></li>
				<?php endif; ?>  
            </ul>
        </div><!--End order-->
      </div>
      <!--End info--> 
    </div>
    <!--End content--> 
<?php get_footer(); ?>
<script type="text/javascript">
	$("#list_order li").mouseenter(function(event){
		var index_parent = $(this).index();
		var index_child = $("#list_contentOrder li.active_contentOrder").index();
		
		if(index_parent != index_child) {
			$("#list_contentOrder li").removeClass("active_contentOrder").hide();
			$("#list_contentOrder li:eq("+index_parent+")").addClass("active_contentOrder").stop( true, true ).fadeIn("slow");
		} 
	});
</script>
