<?php

/*
Plugin Name: Learning assessments Plugin
Description: Custom plugin for embedding Learning assessment tests
Version: 1.0.1
Author: Brad Berger
Author URI: https://bradb.net
*/

// Need jQuery, make sure it's added. Also any local styles/scripts.
wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array());
wp_enqueue_script('learning-assessments', plugin_dir_url( __FILE__ ) . 'js/learning-assessments.js');
wp_enqueue_style('learning-assessments', plugin_dir_url( __FILE__ ) . 'css/learning-assessments.css');

// Add the various test shortcodes below...
add_shortcode('learning-assessment-1', function () {
    require_once plugin_dir_path( __FILE__ ) . 'includes/learning-assessment-1.php';
});

add_shortcode('learning-assessment-2', function() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/learning-assessment-2.php';
});

add_shortcode('learning-assessment-3', function() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/learning-assessment-3.php';
});

add_shortcode('learning-assessment-4', function() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/learning-assessment-4.php';
});

add_shortcode('learning-assessment-5', function() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/learning-assessment-5.php';
});

add_shortcode('dislexia-screener', function() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/dyslexia-screener.php';
});
