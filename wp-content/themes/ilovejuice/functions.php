<?php

update_option('siteurl','http://ilovejuice.fr');
update_option('home','http://ilovejuice.fr');

load_theme_textdomain ( 'ilovejuice' );

add_theme_support( 'woocommerce' );

function f_berries_name_add_scripts() {
	wp_deregister_script ( 'jquery' );
	
	wp_register_script ( 'jquery', get_bloginfo ( 'template_directory' ) . '/js/jquery-1.9.1.min.js' );
	wp_register_script ( 'bootstrap', get_bloginfo ( 'template_directory' ) . '/bootstrap-3.1.1-dist/js/bootstrap.min.js' );
	wp_register_script ( 'fancybox-js', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/source/jquery.fancybox.pack.js?v=2.1.5' );
	wp_register_script ( 'fancybox-js-mousewheel', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js' );
	wp_register_script ( 'fancybox-js-buttons', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5' );
	wp_register_script ( 'fancybox-js-media', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.6' );
	wp_register_script ( 'fancybox-js-thumbs', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7' );
	wp_register_script ( 'init-js', get_bloginfo ( 'template_directory' ) . '/js/init.js' );
	
	
	wp_register_style ( 'bootstrap-css', get_bloginfo ( 'template_directory' ) . '/bootstrap-3.1.1-dist/css/bootstrap-custom.css' );
// 	wp_register_style ( 'bootstrap-responsive-css', get_bloginfo('template_directory') .'/bootstrap-3.1.1-dist/css/bootstrap-responsive.css', array('bootstrap-css'));
// 	wp_register_style ( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/black-tie/jquery-ui.css' );
	wp_register_style ( 'dom-css', get_bloginfo ( 'template_directory' ) . '/style.css', array ('bootstrap-css'));
// 	wp_register_style ( 'dom-css', get_bloginfo ( 'template_directory' ) . '/style.min.css', array ('bootstrap-css'));
	wp_register_style ( 'awesome', "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css", array ('bootstrap-css'));
	wp_register_style ( 'common-css', get_bloginfo ( 'template_directory' ) . '/css/common.css' );

	wp_register_style ( 'fancybox-css', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/source/jquery.fancybox.css?v=2.1.5' );
	wp_register_style ( 'fancybox-css-buttons', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5' );
	wp_register_style ( 'fancybox-css-thumbs', get_bloginfo ( 'template_directory' ) . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7' );
	
	
	// wp_register_script ( 'jcarousel', get_bloginfo('template_directory') .'/js/jquery.jcarousel.min.js');
	// ~ wp_register_style ( 'bootstrap-css', get_bloginfo('template_directory') .'/bootstrap/docs/assets/css/bootstrap.min.css');
	// ~ wp_register_style ( 'bootstrap-responsive-css', get_bloginfo('template_directory') .'/bootstrap/docs/assets/css/bootstrap-responsive.min.min.css', array('bootstrap-css'));
	
	wp_enqueue_script ( 'jquery' );
	wp_enqueue_script ( 'bootstrap' );
	wp_enqueue_script ( 'fancybox-js' );
	wp_enqueue_script ( 'fancybox-js-mousewheel' );
	wp_enqueue_script ( 'fancybox-js-buttons' );
	wp_enqueue_script ( 'fancybox-js-media' );
	wp_enqueue_script ( 'fancybox-js-thumbs' );
	wp_enqueue_script ( 'init-js' );
	
	wp_enqueue_style ( 'bootstrap-css' );
	wp_enqueue_style ( 'jquery-ui' );
	wp_enqueue_style ( 'common-css' );
	wp_enqueue_style ( 'fancybox-css' );
	wp_enqueue_style ( 'fancybox-css-buttons' );
	wp_enqueue_style ( 'fancybox-css-thumbs' );
	wp_enqueue_style( 'bootstrap-responsive-css' );
	wp_enqueue_style ( 'dom-css' );
	wp_enqueue_style ( 'awesome' );
}
add_action ( 'wp_enqueue_scripts', 'f_berries_name_add_scripts' );


if (function_exists ( 'register_sidebar' )) {
	register_sidebar ( array (
		'id' => 'primary',
		'name' => 'Primární postranní panel',
		'description' => 'Hlavní postranní panel', 
		'before_widget' => '<span id="%1$s" class="widget %2$s">',
		'after_widget' => "</span>\n",
		'before_title' => '<h2>',
		'after_title' => "</h2>\n"
	) );
	register_sidebar ( array (
		'id' => 'search',
		'name' => 'Vyhledávání',
		'description' => 'Search sidebar',
		'before_widget' => '<span id="%1$s" class="widget %2$s">',
		'after_widget' => "</span>\n",
		'before_title' => '<h2>',
		'after_title' => "</h2>\n"
	) );
}

function make_mce_awesome($init) {
	$init ['theme_advanced_blockformats'] = 'h2,h3,h4,p';
	$init ['theme_advanced_disable'] = 'underline,spellchecker,wp_help';
	$init ['theme_advanced_text_colors'] = '0f3156,636466,0486d3';
	$init ['theme_advanced_buttons2_add'] = 'styleselect';
// 	$init ['theme_advanced_styles'] = "PDF Download=download-pdf";
	return $init;
}
add_filter ( 'tiny_mce_before_init', 'make_mce_awesome' );

function register_my_menus() {
	register_nav_menus ( array (
			'juice-menu' => __ ( 'I Love Juice Main menu' ),
	) );
	unregister_nav_menu("main-menu");
}
add_action ( 'init', 'register_my_menus' );

// add_filter( 'edit_post_link', 'edit_button_link', 10, 2 );
function edit_button_link($link, $postID) {
	$link = str_replace('class="', 'class="btn btn-mini btn-info ', $link);
	return str_replace('">', '"><i class="icon-pencil"></i> ', $link);
}

// add_filter( 'the_content_more_link', 'the_content_more_link_btn', 10, 2 );
function the_content_more_link_btn($link, $postID) {
	return str_replace('class="more-link', 'class="more-link btn btn-mini pull-right ', $link);
}

add_filter( 'wp_nav_menu_objects', 'last_first_classes' );
/**
* Filters the first and last nav menu objects in your menus
* to add custom classes.
*
* @since 1.0.0
*
* @param object $objects An array of nav menu objects
* @return object $objects Amended array of nav menu objects with new class
*/
function last_first_classes( $objects ) {
 
	
	// Add "first-menu-item" class to the first menu object
	$objects[1]->classes[] = 'first-menu-item';
	 
	// Add "last-menu-item" class to the last menu object
	$objects[count( $objects )]->classes[] = 'last-menu-item';
	
	$i = 1;
	foreach ($objects as $o) {
		if ($o->menu_item_parent == '0') {
			$o->classes[] = "item-pos-".$i++;
		}
	}
	 
// 	var_dump($objects);
	// Return the menu objects
	return $objects;
 
}

function is_subcategory( $cat_id = NULL ) {

	if ( $cat_id ) {
		$args = array(
				'child_of'                 => $cat_id,
				'hide_empty'                 => false
		);
		$cats = get_categories($args);
		
		foreach ($cats as $cat) {
			if (is_category($cat->cat_ID)) {
				return true;
			}
		}
	}

	return false;
}


if (class_exists('MultiPostThumbnails')) {
	new MultiPostThumbnails(
			array(
					'label' => 'Secondary Image',
					'id' => 'secondary-image',
					'post_type' => 'page'
			)
	);
}


require 'classes/Walker_Menu.php';



//http://stackoverflow.com/questions/15661170/how-to-add-the-optional-menu-css-class-to-body-class


// Hook in
// add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// // Our hooked in function – $fields is passed via the filter!
// function custom_override_checkout_fields( $fields ) {

// // 	// we don't need the billing fields so empty all of them except the email
// // 	unset( $fields['billing_country'] );
// // 	unset( $fields['billing_first_name'] );
// // 	unset( $fields['billing_last_name'] );
// // 	unset( $fields['billing_company'] );
// // 	unset( $fields['billing_address_1'] );
// // 	unset( $fields['billing_address_2'] );
// // 	unset( $fields['billing_city'] );
// // 	unset( $fields['billing_email'] );
// // 	unset( $fields['billing_state'] );
// // 	unset( $fields['billing_postcode'] );
// // 	unset( $fields['billing_phone'] );
// // 	var_dump($fields);
	
// // 	unset($fields['order']['order_comments']);
// 	if (WC()->session->get( 'chosen_shipping_methods')[0] == 'local_delivery') {
// 		unset($fields['billing']);
// 		unset($fields['shipping']);
// 		$fields['billing']=array();
// 		$fields['shipping']=array();
// 	}

// 	return $fields;

// }


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function shop_trim_zeros($bool) { return true;}
function my_theme_wrapper_start() {
	echo "<div class='content-wrapper'>";
	echo "<div class='container-fluid'>";
	echo "<div class='row-fluid top'>";
	echo "<div class='col-sm-12 content'>";
}

function my_theme_wrapper_end() {
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
}
