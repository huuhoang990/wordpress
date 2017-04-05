<?php
//Set properties for top menu
if ( function_exists( 'wp_nav_menu' ) ){
	if (function_exists('add_theme_support')) {
		add_theme_support('nav-menus');
		add_action( 'init', 'register_my_menus' );
		  function register_my_menus() {
		   register_nav_menus(
			array(
			 'top-menu1' => __( 'Service design' ),
			 'top-menu2' => __( 'Product and Print'),
			 'top-menu3' => __( 'News'),
			 'bot-menu' => __( 'Orders')
			)
		   );
		  }
		}
}

//active feature image post
add_theme_support( 'post-thumbnails' );

//Add taxonomy for top-slide
add_action( 'init', 'createTopSlideTaxonomies', 0 );
function createTopSlideTaxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'News Image Slide', 'taxonomy general name' ),
    'singular_name' => _x( 'Image Slide category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Image Slide category' ),
    'all_items' => __( 'All Image Slide category' ),
    'parent_item' => __( 'Parent Image Slide category' ),
    'parent_item_colon' => __( 'Parent Image Slide category:' ),
    'edit_item' => __( 'Edit Image Slide category' ), 
    'update_item' => __( 'Update Image Slide category' ),
    'add_new_item' => __( 'Add New Image Slide category' ),
    'new_item_name' => __( 'New Image Slide category Name' ),
    'menu_name' => __( 'Image Slide category' ),
  ); 	

  register_taxonomy('top-slide-category',array('top-slide'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'top-slide-category' ),
  ));
}

function codexCustomInitTopSlide() {
  $labels = array(
    'name' => _x('Image Slide', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Image Slide', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add Image Slide', 'News', 'your_text_domain'),
    'add_new_item' => __('Add New Image Slide', 'your_text_domain'),
    'edit_item' => __('Edit Image Slide', 'your_text_domain'),
    'new_item' => __('New Image Slide', 'your_text_domain'),
    'all_items' => __('All Image Slide', 'your_text_domain'),
    'view_item' => __('View Image Slide', 'your_text_domain'),
    'search_items' => __('Search Image Slide', 'your_text_domain'),
    'not_found' =>  __('No Image Slide', 'your_text_domain'),
    'not_found_in_trash' => __('No Image Slide found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Top Slide', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'top-slide', 'URL slug', 'your_text_domain' ) ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields')
  ); 
  register_post_type('top-slide', $args);
}
add_action( 'init', 'codexCustomInitTopSlide' );

//custom field Top Slide
add_action( 'add_meta_boxes', 'add_metaboxes_topslide' );
function add_metaboxes_topslide() {
	add_meta_box('link-slide', 'Link slide', 'short_topslide_callback','top-slide', 'side', 'default');
}

function short_topslide_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$index_slide = get_post_meta($post->ID, 'link-slide', true);

	echo '<input type="text" name="link-slide" value="'.$index_slide.'" style="width:100%;"/>'; 
}
function save_topslide_box($post_id, $post) {
    if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    }
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
	}
   
    $events_meta['link-slide'] = $_POST['link-slide'];
    // Add values of $events_meta as custom fields
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if (!preg_match("~^(?:f|ht)tps?://~i", $value)) {
        	$value = "http://" . $value;
    	}
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'save_topslide_box', 1, 2); // save the custom fields

//Add taxonomy for news
//create post type news
add_action( 'init', 'create_news_taxonomies', 0 );

function create_news_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'News category', 'taxonomy general name' ),
    'singular_name' => _x( 'News category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search News category' ),
    'all_items' => __( 'All News category' ),
    'parent_item' => __( 'Parent News category' ),
    'parent_item_colon' => __( 'Parent News category:' ),
    'edit_item' => __( 'Edit News category' ), 
    'update_item' => __( 'Update News category' ),
    'add_new_item' => __( 'Add New News category' ),
    'new_item_name' => __( 'New News category Name' ),
    'menu_name' => __( 'News category' ),
  ); 	

  register_taxonomy('news-category',array('news'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'news-category' ),
  ));
}

function codex_custom_init_news() {
  $labels = array(
    'name' => _x('News', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('News', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add New', 'News', 'your_text_domain'),
    'add_new_item' => __('Add New News', 'your_text_domain'),
    'edit_item' => __('Edit News', 'your_text_domain'),
    'new_item' => __('New News', 'your_text_domain'),
    'all_items' => __('All News', 'your_text_domain'),
    'view_item' => __('View News', 'your_text_domain'),
    'search_items' => __('Search News', 'your_text_domain'),
    'not_found' =>  __('No News', 'your_text_domain'),
    'not_found_in_trash' => __('No News found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('News', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'news', 'URL slug', 'your_text_domain' ) ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields')
  ); 
  register_post_type('news', $args);
}
add_action( 'init', 'codex_custom_init_news' );

//custom field News
add_action( 'add_meta_boxes', 'add_metaboxes_news' );
function add_metaboxes_news() {
	add_meta_box('index-slide', 'Index Slide', 'short_news_callback', 'news', 'side', 'default');
	add_meta_box('slogan-news', 'Slogan News', 'short_slogan_news', 'news', 'side', 'default');
}

function short_news_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$index_slide = get_post_meta($post->ID, 'index-slide', true);
	if($index_slide == true) {
		$checked = ' checked';
	}
	echo '<label>Index slide:<input type="checkbox" name="index-slide" '.$checked.' value="true" /><label>'; 
}

function short_slogan_news() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$slogan_news = get_post_meta($post->ID, 'slogan-news', true);
	echo '<textarea name="slogan-news" style="width:100%;">'.$slogan_news.'</textarea>'; 
}

function save_news_box($post_id, $post) {
    if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    }
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
	}
   
    $events_meta['index-slide'] = $_POST['index-slide'];
	$events_meta['slogan-news'] = $_POST['slogan-news'];
    // Add values of $events_meta as custom fields
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'save_news_box', 1, 2); // save the custom fields

//Add taxonomy for brand identity
add_action( 'init', 'createBrandIdentityTaxonomies', 0 );
function createBrandIdentityTaxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'News Brand Identity', 'taxonomy general name' ),
    'singular_name' => _x( 'Image Brand Identity category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Brand Identity category' ),
    'all_items' => __( 'All Brand Identity category' ),
    'parent_item' => __( 'Parent Brand Identity category' ),
    'parent_item_colon' => __( 'Parent Brand Identity category:' ),
    'edit_item' => __( 'Edit Brand Identity category' ), 
    'update_item' => __( 'Update Brand Identity category' ),
    'add_new_item' => __( 'Add New Brand Identity category' ),
    'new_item_name' => __( 'New Brand Identity category Name' ),
    'menu_name' => __( 'Brand Identity category' ),
  ); 	

  register_taxonomy('brand-identity-category',array('brand-identity'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'brand-identity-category' ),
  ));
}

function codexCustomInitBrandIdentity() {
  $labels = array(
    'name' => _x('Brand Identity', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Brand Identity', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add Brand Identity', 'News', 'your_text_domain'),
    'add_new_item' => __('Add New Brand Identity', 'your_text_domain'),
    'edit_item' => __('Edit Brand Identity', 'your_text_domain'),
    'new_item' => __('New Brand Identity', 'your_text_domain'),
    'all_items' => __('All Brand Identity', 'your_text_domain'),
    'view_item' => __('View Brand Identity', 'your_text_domain'),
    'search_items' => __('Search Brand Identity', 'your_text_domain'),
    'not_found' =>  __('No Brand Identity', 'your_text_domain'),
    'not_found_in_trash' => __('No Brand Identity found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Brand Identity', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'brand-identity', 'URL slug', 'your_text_domain' ) ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields')
  ); 
  register_post_type('brand-identity', $args);
}
add_action( 'init', 'codexCustomInitBrandIdentity' );

//Add taxonomy for media print
add_action( 'init', 'createMediaPrintTaxonomies', 0 );
function createMediaPrintTaxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'News Media and Print', 'taxonomy general name' ),
    'singular_name' => _x( 'Image Media and Print category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Media and Print category' ),
    'all_items' => __( 'All Media and Print category' ),
    'parent_item' => __( 'Parent Media and Print category' ),
    'parent_item_colon' => __( 'Parent Media and Print category:' ),
    'edit_item' => __( 'Edit Media and Print category' ), 
    'update_item' => __( 'Update Media and Print category' ),
    'add_new_item' => __( 'Add New Media and Print category' ),
    'new_item_name' => __( 'New Media and Print category Name' ),
    'menu_name' => __( 'Media and Print category' ),
  ); 	

  register_taxonomy('media-print-category',array('media-print'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'media-print-category' ),
  ));
}

function codexCustomInitMediaPrint() {
  $labels = array(
    'name' => _x('Media and Print', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Media and Print', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add Media and Print', 'News', 'your_text_domain'),
    'add_new_item' => __('Add New Media and Print', 'your_text_domain'),
    'edit_item' => __('Edit Media and Print', 'your_text_domain'),
    'new_item' => __('New Media and Print', 'your_text_domain'),
    'all_items' => __('All Media and Print', 'your_text_domain'),
    'view_item' => __('View Media and Print', 'your_text_domain'),
    'search_items' => __('Search Media and Print', 'your_text_domain'),
    'not_found' =>  __('No Media and Print', 'your_text_domain'),
    'not_found_in_trash' => __('No Media and Print found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Media and Print', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'media-print', 'URL slug', 'your_text_domain' ) ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields')
  ); 
  register_post_type('media-print', $args);
}
add_action( 'init', 'codexCustomInitMediaPrint' );

//Add taxonomy for packaging
add_action( 'init', 'createPackagingTaxonomies', 0 );
function createPackagingTaxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'News Packaging', 'taxonomy general name' ),
    'singular_name' => _x( 'Image Packaging category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Packaging category' ),
    'all_items' => __( 'All Packaging category' ),
    'parent_item' => __( 'Parent Packaging category' ),
    'parent_item_colon' => __( 'Parent Packaging category:' ),
    'edit_item' => __( 'Edit Packaging category' ), 
    'update_item' => __( 'Update Packaging category' ),
    'add_new_item' => __( 'Add New Packaging category' ),
    'new_item_name' => __( 'New Packaging category Name' ),
    'menu_name' => __( 'Packaging category' ),
  ); 	

  register_taxonomy('packaging-category',array('packaging'), 
 array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'packaging-category' ),
  ));
}

function codexCustomInitPackaging() {
  $labels = array(
    'name' => _x('Packaging', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Packaging', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add Packaging', 'News', 'your_text_domain'),
    'add_new_item' => __('Add New Packaging', 'your_text_domain'),
    'edit_item' => __('Edit Packaging', 'your_text_domain'),
    'new_item' => __('New Packaging', 'your_text_domain'),
    'all_items' => __('All Packaging', 'your_text_domain'),
    'view_item' => __('View Packaging', 'your_text_domain'),
    'search_items' => __('Search Packaging', 'your_text_domain'),
    'not_found' =>  __('No Packaging', 'your_text_domain'),
    'not_found_in_trash' => __('No Packaging found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Packaging', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'packaging', 'URL slug', 'your_text_domain' ) ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields')
  ); 
  register_post_type('packaging', $args);
}
add_action( 'init', 'codexCustomInitPackaging' );

//Add taxonomy for product
add_action( 'init', 'createProductTaxonomies', 0 );
function createProductTaxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'News Product', 'taxonomy general name' ),
    'singular_name' => _x( 'Image Product category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Product category' ),
    'all_items' => __( 'All Product category' ),
    'parent_item' => __( 'Parent Product category' ),
    'parent_item_colon' => __( 'Parent Product category:' ),
    'edit_item' => __( 'Edit Product category' ), 
    'update_item' => __( 'Update Product category' ),
    'add_new_item' => __( 'Add New Product category' ),
    'new_item_name' => __( 'New Product category Name' ),
    'menu_name' => __( 'Product category' ),
  ); 	

  register_taxonomy('product-category',array('product'), 
 array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product-category' ),
  ));
}

function codexCustomInitProduct() {
  $labels = array(
    'name' => _x('Product', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Product', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add Product', 'News', 'your_text_domain'),
    'add_new_item' => __('Add New Product', 'your_text_domain'),
    'edit_item' => __('Edit Product', 'your_text_domain'),
    'new_item' => __('New Product', 'your_text_domain'),
    'all_items' => __('All Product', 'your_text_domain'),
    'view_item' => __('View Product', 'your_text_domain'),
    'search_items' => __('Search Product', 'your_text_domain'),
    'not_found' =>  __('No Product', 'your_text_domain'),
    'not_found_in_trash' => __('No Product found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Product', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'product', 'URL slug', 'your_text_domain' ) ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields')
  ); 
  register_post_type('product', $args);
}
add_action( 'init', 'codexCustomInitProduct' );

//Add taxonomy for technology
add_action( 'init', 'createTechnologyTaxonomies', 0 );
function createTechnologyTaxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'News Technology', 'taxonomy general name' ),
    'singular_name' => _x( 'Image Technology category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Technology category' ),
    'all_items' => __( 'All Technology category' ),
    'parent_item' => __( 'Parent Technology category' ),
    'parent_item_colon' => __( 'Parent Technology category:' ),
    'edit_item' => __( 'Edit Technology category' ), 
    'update_item' => __( 'Update Technology category' ),
    'add_new_item' => __( 'Add New Technology category' ),
    'new_item_name' => __( 'New Technology category Name' ),
    'menu_name' => __( 'Technology category' ),
  ); 	

  register_taxonomy('technology-category',array('technology'), 
 array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'technology-category' ),
  ));
}

function codexCustomInitTechnology() {
  $labels = array(
    'name' => _x('Technology', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Technology', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add Technology', 'News', 'your_text_domain'),
    'add_new_item' => __('Add New Technology', 'your_text_domain'),
    'edit_item' => __('Edit Technology', 'your_text_domain'),
    'new_item' => __('New Technology', 'your_text_domain'),
    'all_items' => __('All Technology', 'your_text_domain'),
    'view_item' => __('View Technology', 'your_text_domain'),
    'search_items' => __('Search Technology', 'your_text_domain'),
    'not_found' =>  __('No Technology', 'your_text_domain'),
    'not_found_in_trash' => __('No Technology found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Technology', 'your_text_domain')

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'technology', 'URL slug', 'your_text_domain' ) ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields')
  ); 
  register_post_type('technology', $args);
}
add_action( 'init', 'codexCustomInitTechnology' );

//Count view
function my_get_post_views($post_id=0)
{
	$count = 0;
	$post_id = !$post_id ? get_the_ID() : $post_id;
		$meta_count_key = 'my_views_count';
		$count = get_post_meta($post_id, $meta_count_key, true);
		if ($count == '') {
			delete_post_meta($post_id, $meta_count_key);
			add_post_meta($post_id, $meta_count_key, '0');
			return "0 View";
		}
		return ($count + 10);
}

function my_set_post_views($post_id = 0)
{
	$post_id = !$post_id ? get_the_ID() : $post_id;
	if (!$post_id) {
		return;
	}

	$meta_count_key = 'my_views_count';
	$count = get_post_meta($post_id, $meta_count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($post_id, $meta_count_key);
		add_post_meta($post_id, $meta_count_key, '0');
	}
	else {
		$count++;
		update_post_meta($post_id, $meta_count_key, $count);
	}
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//custom field Top Slide
add_action( 'add_meta_boxes', 'add_metaboxes_order' );

function add_metaboxes_order() {
	//add metabox "short code contact" for contact page
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
 	if($post_id==135 || $post_id == 188){
		add_meta_box('step1', 'Step 1', 'short_orderstep1_callback', 'page', 'side', 'default');
		add_meta_box('step2', 'Step 2', 'short_orderstep2_callback', 'page', 'side', 'default');
		add_meta_box('step3', 'Step 3', 'short_orderstep3_callback', 'page', 'side', 'default');
		add_meta_box('step4', 'Step 4', 'short_orderstep4_callback', 'page', 'side', 'default');
		add_meta_box('step5', 'Step 5', 'short_orderstep5_callback', 'page', 'side', 'default');
		add_meta_box('step6', 'Step 6', 'short_orderstep6_callback', 'page', 'side', 'default');
	}
}

function short_orderstep1_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$step1 = get_post_meta($post->ID, 'step1', true);
	echo '<textarea name="step1" style="width:100%;">'. $step1 .'</textarea>';
}

function short_orderstep2_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$step2 = get_post_meta($post->ID, 'step2', true);
	echo '<textarea name="step2" style="width:100%;">'. $step2 .'</textarea>';
}

function short_orderstep3_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$step3 = get_post_meta($post->ID, 'step3', true);
	echo '<textarea name="step3" style="width:100%;">'. $step3 .'</textarea>';
}

function short_orderstep4_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$step4 = get_post_meta($post->ID, 'step4', true);
	echo '<textarea name="step4" style="width:100%;">'. $step4 .'</textarea>';
}

function short_orderstep5_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$step5 = get_post_meta($post->ID, 'step5', true);
	echo '<textarea name="step5" style="width:100%;">'. $step5 .'</textarea>';
}

function short_orderstep6_callback() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	$step6 = get_post_meta($post->ID, 'step6', true);
	echo '<textarea name="step6" style="width:100%;">'. $step6 .'</textarea>';
}

function save_order_box($post_id, $post) {
    if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    }
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
	}
   
    $events_meta['step1'] = $_POST['step1'];
    $events_meta['step2'] = $_POST['step2'];
    $events_meta['step3'] = $_POST['step3'];
    $events_meta['step4'] = $_POST['step4'];
    $events_meta['step5'] = $_POST['step5'];
    $events_meta['step6'] = $_POST['step6'];

    // Add values of $events_meta as custom fields
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'save_order_box', 1, 2); // save the custom fields
?>