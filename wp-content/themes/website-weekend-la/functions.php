<?php 

function wwla_enqueue_scripts(){
	wp_dequeue_style( 'profile-style' );
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'wwla-style', get_stylesheet_uri(), array('parent-style') );
} 
add_action( 'wp_enqueue_scripts', 'wwla_enqueue_scripts', 20 );

