<?php

/*
Plugin Name: Learning Assesments Plugin
Description: Custom plugin for embedding Learning Assesment tests
Version: 1.0.0
Author: Brad Berger
Author URI: https://bradb.net
*/

// Need jQuery, make sure it's added.
wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array());

// Add the various test shortcodes below...
add_shortcode('learning-assessment-1', function() {
    include_once dirname(__FILE__) . '/includes/learning-assesment-1.php';
});

add_shortcode('dyslexia-screener', function() {
    include_once dirname(__FILE__) . '/includes/dyslexia-screener.php';
});
