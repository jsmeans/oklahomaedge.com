<?php 

function s42_register_theme_customizer( $wp_customize ) {

  //var_dump( $wp_customize );

  // Customize title and tagline sections and labels
  $wp_customize->get_section('title_tagline')->title = __('Site Name and Description', 's42themecustomizer');  
  $wp_customize->get_control('blogname')->label = __('Site Name', 's42themecustomizer');  
  $wp_customize->get_control('blogdescription')->label = __('Site Description', 's42themecustomizer');  
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

  // Customize the Front Page Settings
  $wp_customize->get_section('static_front_page')->title = __('Homepage Preferences', 's42themecustomizer');
  $wp_customize->get_section('static_front_page')->priority = 20;
  $wp_customize->get_control('show_on_front')->label = __('Choose Homepage Preference', 's42themecustomizer');  
  $wp_customize->get_control('page_on_front')->label = __('Select Homepage', 's42themecustomizer');  
  $wp_customize->get_control('page_for_posts')->label = __('Select Blog Homepage', 's42themecustomizer');  

  // Customize Background Settings
  $wp_customize->get_section('background_image')->title = __('Background Styles', 's42themecustomizer');  
  $wp_customize->get_control('background_color')->section = 'background_image'; 

  // Customize Header Image Settings  
  $wp_customize->add_section( 'header_text_styles' , array(
    'title'      => __('Header Text Styles','s42themecustomizer'), 
    'priority'   => 30    
  ) );
  $wp_customize->get_control('display_header_text')->section = 'header_text_styles';  
  $wp_customize->get_control('header_textcolor')->section = 'header_text_styles'; 
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage'; 


 // Create custom panels
  $wp_customize->add_panel( 'general_settings', array(
      'priority' => 10,
      'theme_supports' => '',
      'title' => __( 'General Settings', 'wptthemecustomizer' ),
      'description' => __( 'Controls the basic settings for the theme.', 'wptthemecustomizer' ),
  ) );
  $wp_customize->add_panel( 'design_settings', array(
      'priority' => 20,
      'theme_supports' => '',
      'title' => __( 'Design Settings', 'wptthemecustomizer' ),
      'description' => __( 'Controls the basic design settings for the theme.', 'wptthemecustomizer' ),
  ) ); 

  // Assign sections to panels
  $wp_customize->get_section('title_tagline')->panel = 'general_settings';      
  $wp_customize->get_section('nav')->panel = 'general_settings';
  $wp_customize->get_section('static_front_page')->panel = 'general_settings';
  $wp_customize->get_section('header_text_styles')->panel = 'design_settings';
  $wp_customize->get_section('background_image')->panel = 'design_settings';
  $wp_customize->get_section('background_image')->priority = 1000;
  $wp_customize->get_section('header_image')->panel = 'design_settings';  

}


add_action( 'customize_register', 's42_register_theme_customizer' );

// Custom js for theme customizer
function s42_customizer_js() {
  wp_enqueue_script(
    's42_theme_customizer',
    get_template_directory_uri() . '/js/theme-customizer.js',
    array( 'jquery', 'customize-preview' ),
    '',
    true
);
}

// Add theme support for custom backgrounds //

add_action( 'customize_preview_init', 's42_customizer_js' );

$defaults = array(
  'default-color'          => '',
  'default-image'          => '',
  'wp-head-callback'       => '_custom_background_cb',
  'admin-head-callback'    => '',
  'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

// Add theme support for custom backgrounds //

$defaults = array(
  'default-image'          => '',
  'random-default'         => false,
  'width'                  => 0,
  'height'                 => 0,
  'flex-height'            => false,
  'flex-width'             => false,
  'default-text-color'     => '',
  'header-text'            => true,
  'uploads'                => true,
  'wp-head-callback'       => '',
  'admin-head-callback'    => '',
  'admin-preview-callback' => '',
);

// Add theme support for Custom Header Image
$defaults = array(
  'flex-width'    => true,
  'width'         => 980,
  'flex-height'    => true,
  'height'        => 200,
  'default-text-color'     => '36b55c',
  'header-text'            => true,
  'uploads'                => true,
  'wp-head-callback'       => 's42_style_header'
);
add_theme_support( 'custom-header', $defaults );


// Callback function for updating header styles
function s42_style_header() {

  $text_color = get_header_textcolor();
  
  ?>
  
  <style type="text/css">

  #header .site-title a {
    color: #<?php echo esc_attr( $text_color ); ?>;
  }
  
  <?php if(display_header_text() != true): ?>
  .site-title {
    display: none;
  } 
  <?php endif; ?>
 
  </style>
  <?php 

}

register_nav_menus(
        array(
            'first-menu' => __( 'First Menu' ),
            'second-menu' => __( 'Second Menu' ),
            'third-menu' => __( 'Third Menu' )
        )
    );


add_theme_support( 'post-thumbnails' );

function s42_excerpt_length( $length ) {
	return 16;
}
add_filter( 'excerpt_length', 's42_excerpt_length', 999 );

function register_theme_menus() {

	register_nav_menus(
		array(
			'primary-menu' 	=> __( 'Primary Menu' )			
		)
	);

}
add_action( 'init', 'register_theme_menus' );


function s42_create_widget( $name, $id, $description ) {

	register_sidebar(array(
		'name' => __( $name ),	 
		'id' => $id, 
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="module-heading">',
		'after_title' => '</h2>'
	));

}

s42_create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar' );
s42_create_widget( 'Blog Sidebar', 'blog', 'Displays on the side of pages in the blog section' );
s42_create_widget('Left Footer', "footer_left", "Displays in the bottom left of footer");
s42_create_widget('Middle Footer', "footer_middle", "Displays in the bottom middle of footer");
s42_create_widget('Right Footer', "footer_right", "Displays in the bottom right of footer");


function s42_theme_styles() {

	wp_enqueue_style( 'foundation_css', get_template_directory_uri() . '/css/foundation.css' );
  wp_enqueue_style( 'grid_css', get_template_directory_uri() . '/css/grid.css' );
	wp_enqueue_style( 'normalize_css', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style( 'googlefont_css', 'http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 's42_theme_styles' );



function s42_theme_js() {

	wp_enqueue_script( 'modernizr_js', get_template_directory_uri() . '/js/modernizr.js', '', '', false );	
	wp_enqueue_script( 'foundation_js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/app.js', array('jquery', 'foundation_js'), '', true );		

}
add_action( 'wp_enqueue_scripts', 's42_theme_js' );








?>