<?php
/*
Plugin Name: Simple Submit SEO / Social Bookmarking Plugin
Plugin URI: http://blueberryware.net/2008/09/06/simple-submit-seo-plugin/
Description: Displays submit buttons to Digg, del.icio.us, stumble upon, and buzz.  Clean and simple interface.  Requires wp_head hook in template to insert stylesheet for plugin
Author: Adam Hunter
Version: 1.0
Author URI: http://blueberryware.net
*/

/**
 * initializes simple submit plugin constants and adds options
 */
function simple_submit_init() {
	define('SIMPLESUBMIT_NONCE', 'simple-submit-options');
	define('SIMPLESUBMIT_HOMEPAGE', 'simple_submit_homepage');
	define('SIMPLESUBMIT_POSTPAGE', 'simple_submit_postpage');
	define('SIMPLESUBMIT_ALLPOSTS', 'simple_submit_allposts');
	define('SIMPLESUBMIT_ALLPAGES', 'simple_submit_allpages');
	define('SIMPLESUBMIT_SINGLEPOST', 'simple_submit_singlepost');
	define('SIMPLESUBMIT_OTHERTYPE', 'simple_submit_othertype');
	define('SIMPLESUBMIT_DIR', WP_PLUGIN_DIR . '/simple-submit/');
	define('SIMPLESUBMIT_URL', WP_PLUGIN_URL . '/simple-submit/');
	define('SIMPLESUBMIT_DIGG', 'http://digg.com/submit?url=%s&amp;title=%s');
	define('SIMPLESUBMIT_DELICIOUS', 'http://delicious.com/post?url=%s&amp;title=%s');
	define('SIMPLESUBMIT_STUMBLE', 'http://www.stumbleupon.com/submit?url=%s&amp;title=%s');
	define('SIMPLESUBMIT_BUZZ', 'http://buzz.yahoo.com/submit?submitUrl=%s&amp;submitHeadline=%s');
	add_option(SIMPLESUBMIT_HOMEPAGE, 1);
	add_option(SIMPLESUBMIT_POSTPAGE, 1);
	add_option(SIMPLESUBMIT_ALLPOSTS, 1);
	add_option(SIMPLESUBMIT_ALLPAGES, 1);
	add_option(SIMPLESUBMIT_SINGLEPOST, 1);
	add_option(SIMPLESUBMIT_OTHERTYPE, 0);
}

/**
 * Inserts simple submit stylesheet into head tag
 */
function setup_simple_submit() {
	if ( !is_simple_submit()) {
		return;
	}
	simple_submit_css();
	add_filter('the_content', 'get_simple_submit');
	return;
}

/**
 * creates css file link for simple submit
 */
function simple_submit_css() {
	echo '<!-- Simple Submit Style -->';
	echo '<style type="text/css"><!--' . PHP_EOL;
	include SIMPLESUBMIT_DIR . 'simple-submit-css.php';
	echo '--></style>';
	echo '<!-- End Simple Submit Style-->';
}

/**
 * echos string for checking checkbox is value is true
 *
 * @param bool $option
 */
function simple_submit_checked($option) {
	if ( $option ) {
		echo 'checked="checked"';
	}
}

/**
 * Gets view script for simple submit plugin
 *
 * @param string $view
 * @return string
 */
function get_simple_submit_view() {
	ob_start();
	require SIMPLESUBMIT_DIR . 'simple-submit-view.php';
	return ob_get_clean();
}

/**
 * Creates submission url to service from the parameters url and title
 *
 * @param string $href
 * @param string $url
 * @param string $title
 * @return string
 */
function get_simple_submit_href($href, $url, $title) {
	return sprintf($href, urlencode($url), urlencode($title));
}

/**
 * Plugin callback function, gets simple submit 
 * view script and appends to content
 *
 * @param string $content
 * @return string
 */
function get_simple_submit($content) {
	return $content . get_simple_submit_view();
}

/**
 * Checks to see if simple submit is going to run on the requested page
 *
 * @return bool
 */
function is_simple_submit() {
	if ( is_front_page() ) {
		return get_option(SIMPLESUBMIT_HOMEPAGE);
	} else if ( is_home() ) {
		return get_option(SIMPLESUBMIT_POSTPAGE);
	} else if ( is_page() ) {
		return get_option(SIMPLESUBMIT_ALLPAGES);
	} else if ( is_archive() ) {
		return get_option(SIMPLESUBMIT_ALLPOSTS);
	} else if ( is_single() ) {
		return get_option(SIMPLESUBMIT_SINGLEPOST);
	} else {
		return get_option(SIMPLESUBMIT_OTHERTYPE);
	}
}

/**
 * checks wp_nonce, then takes posted options and updates them
 *
 * @param array $options
 * @return bool
 */
function set_simple_submit_options($options) {
	check_admin_referer(SIMPLESUBMIT_NONCE);
	$keys = array(SIMPLESUBMIT_HOMEPAGE, 
				  SIMPLESUBMIT_POSTPAGE, 
				  SIMPLESUBMIT_ALLPOSTS, 
				  SIMPLESUBMIT_ALLPAGES,
				  SIMPLESUBMIT_SINGLEPOST,
				  SIMPLESUBMIT_OTHERTYPE);
	foreach ( $keys as $key ) {
		if ( empty($options[$key]) ) {
			$value = 0;
		} else {
			$value = 1;
		}
		update_option($key, $value);
	}
	return true;
}

/**
 * Requires simple submit admin view script and toggles saved value
 * Also sends values to set_simple_submit_options to be checked and saved
 */
function simple_submit_admin() {
	$saved = false;
	if ( $_POST['simple_submit'] ) {
		$saved = set_simple_submit_options($_POST);
	}
	require SIMPLESUBMIT_DIR . 'simple-submit-admin.php';	
}

/**
 * adds simple submit options page link to settings sub menu
 */
function simple_submit_add_option_page() {
	add_options_page('Simple Submit Options', 
					 'Simple Submit', 
					 8, 
					 basename(__FILE__), 
					 'simple_submit_admin' );
}

/**
 * setup simple submit to define constants that will be needed,
 * adds options if necessary
 */
simple_submit_init();

/* register actions and filters */

/**
 *  register simple submit with the wp_head, 
 *  run determination will be made there and 
 *  setup action hook with the_content
 */
add_action('wp_head', 'setup_simple_submit');
/**
 * register with admin menu to create link to options page
 */
add_action('admin_menu', 'simple_submit_add_option_page');