<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset')?>" />
<title><?php bloginfo('name'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/layout.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/inpage.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/base.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/css/nivo-slider.css" />
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body>
<!--wrapper-->
<div id="wrapper"> 
  <!--wrapper_inner-->
  <div id="wrapper_inner"> 
    <!--header-->
    <div id="header" class="clearfix2"> 
      <!--logo-->
      <div id="logo"><a href="<?php bloginfo("home"); ?>"><img width="430" height="186" src="<?php bloginfo("template_url"); ?>/images/logo.png" /></a></div>
      <!--End logo--> 
      <!--social_area-->
      <div class="social_area">
        <div class="social_block"><a ref="nofollow" title="facebook" href="https://www.facebook.com/ctythehetre" target="_blank"><img src="<?php bloginfo("template_url"); ?>/images/facebook_icon.png" /></a></div>
        <div class="social_block"><a title="Skype" href="skype:thangmagical111?chat"><img src="<?php bloginfo("template_url"); ?>/images/skype_icon.png" /></a></div>
        <div class="social_block">
        	<div id="fb-root"></div>
			<div class="fb-like" data-href="http://www.thehetreart.com.vn/" data-width="100" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
        <div  class="social_block"><div class="g-plusone" data-size="medium" data-annotation="none"></div></div>
      </div>
      <!--End social_area--> 
      <!--language_area-->
      <div class="language_area">
		<?php 
			$obj = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str'); 
			$arr_vi = $obj["vi"];
			$arr_en = $obj["en"];
			$url_vi = $arr_vi["url"];
			$url_en = $arr_en["url"];
		?>
        <div class="language_block vn_language"><a href="<?php echo $url_vi; ?>"><img src="<?php bloginfo("template_url"); ?>/images/vn_icon.png" /></a></div>
        <div class="language_block"><a href="<?php echo $url_en; ?>"><img src="<?php bloginfo("template_url"); ?>/images/en_icon.png" /></a></div>
      </div>
      <!--End language_area--> 
      <!--view_rate-->
      <div id="view_rate">
        <p>
        	<?php
				my_set_post_views(181);
				echo '<span class="numberViewRate">'. (my_get_post_views(181)) .'</span>';
				if($_GET['lang']=='en'){
					echo '<span class="textViewRate">views</span>';
				}
				else {
					echo ' <span class="textViewRate">lượt xem</span>';
				}
			?> 
        </p>
      </div>
      <!--view_rate-->
      <!--top_nav-->
      <?php include(TEMPLATEPATH.'/top-menu.php'); ?>
      <!--End top_nav-->
      <div class="cb"></div> 
    </div>
    <!--End header--> 
    <!--top_slider-->
    <?php
		if (is_home()) {
			include(TEMPLATEPATH.'/top-slide.php');
		} 
	?>
    <!--End top_slider--> 