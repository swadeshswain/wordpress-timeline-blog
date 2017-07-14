<?php
/**
 * Plugin Name: My Timeline Blog
 * Plugin URI:        https://swadeshswain.com/
 * Description:       My Blog Timeline is the Great WordPress Blog Timeline Plugin, through which users can create unlimited blog post with  Vertical timelines.
 * Version:           1.0.0
 * Author:            swadeshswain
 * Author URI:        http://swadeshswain.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       my-timeline-blog
 */
 
 // If this file is called directly, abort.
 if ( ! defined( 'WPINC' ) ) {
	die;
 }
 define( 'MTB_URL_PATH', plugin_dir_url( __FILE__ ) );
 define( 'MTB_PLUGIN_PATH', plugin_dir_path(__FILE__) );
 function mtb_scripts()
{
     $plugin_url = plugin_dir_url( __FILE__ );
     wp_register_script( 'custom-script', MTB_URL_PATH. '/js/jquery-mtb-timeline-2.0.1.min.js');
     wp_register_style( 'custom-script', MTB_URL_PATH . 'css/style-mtb-timeline.css' );
	 wp_register_style( 'custom-script', MTB_URL_PATH . 'css/mtb-animate.min.css' );
     wp_register_style( 'custom-script', MTB_URL_PATH . 'css/bootstrap.min.css' );
     wp_enqueue_script( 'custom-script' );
	 wp_enqueue_style ( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'mtb_scripts' );
include( plugin_dir_path( __FILE__ ) . 'lib/mtb-posttype.php');
include( plugin_dir_path( __FILE__ ) . 'lib/mtb-shortcode.php');