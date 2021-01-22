<?php

function _themename_sidebar_widgets() {
	register_sidebar( array(
    'id'            => 'primary-sidebar',
		'name'          => esc_html__( 'Primary Sidebar', '_themename' ),
		'description'   => esc_html__( 'Add widgets here.', '_themename' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
  ));
}

add_action( 'widgets_init', '_themename_sidebar_widgets' );

function _themename_footer_widgets() {
  register_sidebar( array(
    'id'            => 'footer_one',
    'name'          => 'Footer One',
    'before_widget' => '<section class="footer-area footer-one">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
	
	register_sidebar( array(
    'id'            => 'footer_two',
    'name'          => 'Footer Two',
    'before_widget' => '<section class="footer-area footer-two">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));

  register_sidebar( array(
    'id'            => 'footer_three',
    'name'          => 'Footer Three',
    'before_widget' => '<section class="footer-area footer-three">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));

  register_sidebar( array(
    'id'            => 'footer_four',
    'name'          => 'Footer Four',
    'before_widget' => '<section class="footer-area footer-four">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
}

add_action( 'widgets_init', '_themename_footer_widgets' );

?>