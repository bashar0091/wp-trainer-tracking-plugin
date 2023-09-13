<?php
/**
 * Plugin Name: Gym Core
 * Plugin URI: 
 * Description: 
 * Version: 1.0.0
 * Author: Awal Bashar
 * Author URI: 
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: gym
 */


// Prevent direct access to the plugin file
defined( 'ABSPATH' ) || exit;


/**
 * 
 * Require All Css Files Here
 * 
 */
function gym_enqueue_style() {
    wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', array(), '1.0.0' );
    wp_enqueue_style( 'customs-style', plugin_dir_url( __FILE__ ) . 'assets/css/custom.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'gym_enqueue_style' );


/**
 * 
 * Require All Js Files Here
 * 
 */
function gym_enqueue_scripts() {
    wp_enqueue_script( 'jquery-ui-script', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'replicate-script', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.replicate.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'book-script', plugin_dir_url( __FILE__ ) . 'assets/js/jquery-book.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'customs-script', plugin_dir_url( __FILE__ ) . 'assets/js/custom.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'gym_enqueue_scripts' );


/**
 * 
 * Require All Includes Files Here
 * 
 */
require_once plugin_dir_path( __FILE__ ) . 'shortcode/trainer-dashboard.php';
require_once plugin_dir_path( __FILE__ ) . 'shortcode/new-exercise.php';
require_once plugin_dir_path( __FILE__ ) . 'controllers/insert-exercise-in-post-type.php';