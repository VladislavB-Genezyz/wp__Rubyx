<?php

function wpRubyx_setup(){
	load_theme_textdomain( 'wpRubyx');
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array(
		'search_form',
		'comment_form',
		'comment_list',
		'gallery',
		'caption'
	));

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'gallery'
	));
	register_nav_menu( 'primary', 'Primary menu' );
}
add_action('after_setup_theme', 'wpRubyx_setup');

function load_css_scripts(){
	wp_enqueue_style('style.css', get_stylesheet_uri());		
	// wp_enqueue_style('aural', get_template_directory_uri().'/css/aural.css');
	// wp_enqueue_style('print', get_template_directory_uri().'/css/print.css');
	// wp_enqueue_script( '$handle', '$src', array( 'jquery' ), false, false );
	
	
}
add_action( 'wp_enqueue_scripts', 'load_css_scripts' );
?>