<?php 
/*
Template Name: Contact
*/
get_header();
?>
    <!--content-->
    <div id="content">
      <div class="category_lable">
        <p>LIÊN HỆ VỚI CHÚNG TÔI</p>
      </div>
      <!--info-->
      <div id="info" class="clearfix">
        <!--contact_area-->
        <div id="contact_area">
		<?php if(have_posts()): the_post(); ?>
 		<?php the_content(); ?>
          <?php endif; ?>  
        </div>
        <!--End contact_area--> 
      </div>
      <!--End info--> 
    </div>
    <!--End content-->
 <?php get_footer(); ?>
 <script type="text/javascript">
	var arr_provide = [
		[
			"[Sản phẩm quan tâm]",
			"Bao bì",
			"Khác"
		],
		[
			"[Sản phẩm quan tâm]",
			"Danh thiếp",
			"Tờ rơi",
			"Khác"
		],
		[
			"[Sản phẩm quan tâm]",
			"Khác"
		],
		[
			"[Sản phẩm quan tâm]",
			"Khác"
		],
		[
			"[Sản phẩm quan tâm]",
			"Khác"
		]	
	]
	$("#require_customer").change(function(){
		var index = $("option:selected", this).index();console.log(index);
		var arr = arr_provide[index];
		$("#provide_customer").html("");
		for(var i = 0; i < arr.length; i++){
			$("#provide_customer").append("<option value='" + arr[i] + "'>" + arr[i] + "</option>")
		} 
	});
</script>