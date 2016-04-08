<?php 
function register_google_reviews_styles() {
	wp_register_style('google-reviews', WP_PLUGIN_URL . '/ff-google-reviews/style.css');
	wp_enqueue_style('google-reviews');
}
add_action( 'wp_enqueue_scripts', 'register_google_reviews_styles' );
?>