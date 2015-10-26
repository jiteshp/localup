<?php
/**
 *	Theme functions
 *	
 *	This file contains the functions, hooks and filters used in the theme.
 *
 *	@package localup
 *	@since LocalUp 1.0
 *	----------------------------------------------------------------------------
 */

/**
 *	Set content width in pixels according to the theme's design. Override by 
 *	hooking into the 'localup_content_width' filter.
 *	
 *	@since LocalUp 1.0
 */
function localup_content_width() {
	$GLOBAL['content_width'] = apply_filters( 'localup_content_width', 600 );
}

add_action( 'after_setup_theme', 'localup_content_width' );

/**
 *	Set up various theme features as required in the theme. Override in the 
 *	child theme by creating your own localup_setup() function.
 *	
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_setup' ) ) {
	function localup_setup() {
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'custom-background', array(
			'default-color'	=> 'FFFFFF',
		) );
		
		add_theme_support( 'custom-header', array(
			'flex-height'	=> true,
			'flex-width'	=> true,
			'header-text'	=> false,
			'height'		=> 800,
			'width'			=> 1200,
		) );
		
		add_theme_support( 'html5', array(
			'caption', 'comment-form', 'comment-list', 'gallery', 'search-form',
		) );
		
		add_theme_support( 'post-thumbnails' );
		
		add_theme_support( 'title-tag' );
		
		register_nav_menus( array(
			'localup_nav_menu'	=> 'Navigation Menu',
		) );
	}
}

add_action( 'after_setup_theme', 'localup_setup' );

/**
 *	Enqueues the various styles & scripts as required in the theme. Override in 
 *	the child theme by creating your own localup_enqueue_scripts() function.
 *	
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_enqueue_scripts' ) ) {
	function localup_enqueue_scripts() {
		wp_enqueue_style( 'localup-fonts', localup_get_fonts_url() );
		
		wp_enqueue_style( 'localup-icons', localup_get_icons_url() );
		
		wp_enqueue_style( 'localup-style', get_stylesheet_uri() );
		
		if( is_singular() && 
			comments_open() && 
			get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'localup-fitvids',
			get_template_directory_uri() . '/js/jquery.fitvids.js',
			array( 'jquery' ), null, true );
		
		wp_enqueue_script( 'localup-match-height',
			get_template_directory_uri() . '/js/jquery.matchHeight.js',
			array( 'jquery' ), null, true );
		
		wp_enqueue_script( 'localup-scroll-to',
			get_template_directory_uri() . '/js/jquery.scrollTo.js',
			array( 'jquery' ), null, true );
		
		wp_enqueue_script( 'localup-script',
			get_template_directory_uri() . '/js/script.js',
			array( 'localup-fitvids', 'localup-match-height', 'localup-scroll-to' ), 
			null, true );
	}
}

add_action( 'wp_enqueue_scripts', 'localup_enqueue_scripts' );

/**
 *	Register the various widget areas as required in the theme. Override in the
 *	child theme by creating your own localup_widgets_init() function.
 *	
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_widgets_init' ) ) {
	function localup_widgets_init() {
		register_sidebar( array(
			'id'			=> 'localup_sidebar_widgets',
			'name'			=> 'Sidebar',
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		
		register_sidebar( array(
			'id'			=> 'localup_afterpost_widgets',
			'name'			=> 'After Post',
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
		) );
		
		register_sidebar( array(
			'id'			=> 'localup_hero_widgets',
			'name'			=> 'Hero',
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s"><div class="container">',
			'after_widget'	=> '</div></aside>',
			'before_title'	=> '<h2 class="widget-title">',
			'after_title'	=> '</h2>',
		) );
		
		register_sidebar( array(
			'id'			=> 'localup_footer_widgets',
			'name'			=> 'Footer',
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s"><div class="container">',
			'after_widget'	=> '</div></aside>',
			'before_title'	=> '<h2 class="widget-title">',
			'after_title'	=> '</h2>',
		) );
	}
}

add_action( 'widgets_init', 'localup_widgets_init' );

/**
 *	Set the default image sizes used in the theme. Override in the child theme 
 *	by creating your own localup_images().
 *	
 *	@param $wp_customize WP_Customize_Manager object
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_images' ) ) {
	function localup_images() {
		update_option( 'large_size_h', 0 );
		update_option( 'large_size_w', 0 );
		
		update_option( 'medium_size_h', 0 );
		update_option( 'medium_size_w', 0 );
		
		update_option( 'thumbnail_size_h', 0 );
		update_option( 'thumbnail_size_w', 0 );
		
		set_post_thumbnail_size( 1200, 627 );
	}
}

add_action( 'after_setup_theme', 'localup_images' );
 
/**
 *	Completely remove unwanted taxonomies. Override in the child theme by 
 *	creating your own localup_unregister_taxonomy().
 *	
 *	@param $wp_customize WP_Customize_Manager object
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_unregister_taxonomy' ) ) {
	function localup_unregister_taxonomy() {
		register_taxonomy( 'post_tag', array() );
	}
}

add_action( 'init', 'localup_unregister_taxonomy' );
 
/**
 *	Register the various customizer options as required in the theme. Override 
 *	in the child theme by creating your own localup_customize_register() 
 *	function.
 *	
 *	@param $wp_customize WP_Customize_Manager object
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_customize_register' ) ) {
	function localup_customize_register( $wp_customize ) {
		$wp_customize->add_setting( 'localup_accent_color', array(
			'default'	=> '#29B6F6',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'localup_accent_color', array(
				'label'		=> 'Accent Color',
				'section'	=> 'colors',
			)
		) );
		
		$wp_customize->add_setting( 'localup_alt_accent_color', array(
			'default'	=> '#0993D2',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'localup_alt_accent_color', array(
				'label'		=> 'Alternate Accent Color',
				'section'	=> 'colors',
			)
		) );
		
		$wp_customize->add_setting( 'localup_logo' );
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(  
			$wp_customize, 'localup_logo', array(
				'flex-width'=> true,
				'height'	=> 90,
				'width'		=> 270,
				'label'		=> 'Logo',
				'section'	=> 'title_tagline',
			)
		) );
	}
}

add_action( 'customize_register', 'localup_customize_register' );

/**
 *	Output the customizer options as required in the theme. Override in the 
 *	child theme by creating your own localup_customize_output() function.
 *	
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_customize_output' ) ) {
	function localup_customize_output() {
		$accent_color = get_theme_mod( 'localup_accent_color', '#29B6F6' );
		$alt_accent_color = get_theme_mod( 'localup_alt_accent_color', '#0993D2' );
		$header_image = get_header_image();
		
		ob_start(); ?>
		
<style id="custom-styles" type="text/css">
	a {
		border-color: <?php echo $accent_color ?>;
		color: <?php echo $accent_color ?>;
	}
	a:hover {
		border-color: <?php echo $alt_accent_color ?>;
		color: <?php echo $alt_accent_color ?>;
	}
	h1 a:hover, 
	h2 a:hover, 
	.entry-meta a:hover {
		color: <?php echo $accent_color ?>;
	}
	.button, 
	input[type=submit] {
		background-color: <?php echo $accent_color ?>;
		border-color: <?php echo $accent_color ?>;
	}
	.button:hover, 
	input[type=submit]:hover {
		background-color: <?php echo $alt_accent_color ?>;
		border-color: <?php echo $alt_accent_color ?>;
	}
	.light-on-dark .button:hover, 
	.light-on-dark input[type=submit]:hover {
		color: <?php echo $accent_color ?>;
	}
	#nav-menu .toggle {
		background-color: <?php echo $accent_color ?>;
	}
	#sidebar .widget.highlight, 
	#hero-widgets .widget:first-child,
	#footer-widgets .widget:nth-child( odd ),
	#after-post-widgets .widget {
		background-color: <?php echo $accent_color ?>;
	}
	#hero-widgets .widget:first-child {
		background-image: url( '<?php echo esc_url( $header_image ) ?>' );
	}
</style> <?php

		echo ob_get_clean() . "\n\n";
	}
}

add_action( 'wp_head', 'localup_customize_output' );

/**
 *	Add a 'read more' link after the post excerpt. Override text by hooking into 
 *	the 'localup_read_more_text' filter.
 *	
 *	@param string $more default more text
 *	@return string custom more text
 *	@since LocalUp 1.0
 */
function localup_excerpt_more( $more ) {
	global $post;
	
	return '&nbsp;&hellip;' . 
		sprintf( '<p><a href="%1$s" class="read-more">%2$s</a></p>',
			esc_url( get_permalink( $post->ID ) ),
			apply_filters( 'localup_read_more_text', 'Read more' ) );
}

add_filter( 'excerpt_more', 'localup_excerpt_more' );

/**
 *	Change the default post excerpt. Override by hooking into 
 *	'localup_excerpt_length' filter.
 *	
 *	@param int $length default excerpt length
 *	@return int custom excerpt length
 *	@since LocalUp 1.0
 */
function localup_excerpt_length( $length ) {
	return apply_filters( 'localup_excerpt_length', 25 );
}

add_filter( 'excerpt_length', 'localup_excerpt_length' );

/**
 *	Remove unsupported widgets. Override in your child theme by creating your 
 *	own localup_unsupported_widgets() function.
 *	
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_unsupported_widgets' ) ) {
	function localup_unsupported_widgets() {
		$unsupported_widgets = array(
			'WP_Widget_Pages',
			'WP_Widget_Calendar',
			'WP_Widget_Archives',
			'WP_Widget_Links',
			'WP_Widget_Meta',
			'WP_Widget_Categories',
			'WP_Widget_Recent_Comments',
			'WP_Widget_RSS',
			'WP_Widget_Tag_Cloud',
			'WP_Nav_Menu_Widget',
		);
		
		foreach( $unsupported_widgets as $widget ) {
			unregister_widget( $widget );
		}
	}
}

add_filter( 'widgets_init', 'localup_unsupported_widgets' );

/**
 *	Unregister plugin styles.
 *	
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_remove_plugin_styles' ) ) {
	function localup_remove_plugin_styles() {
		$plugin_styles = array(
			'contact-form-7',
			'contact-form-7-rtl',
		);
		
		foreach( $plugin_styles as $style ) {
			wp_deregister_style( $style );
		}
	}
}

add_filter( 'wp_print_styles', 'localup_remove_plugin_styles' );

/**
 *	Custom templating for base wrapper template.
 *	
 *	@param string $template requested by WordPress
 *	@return string 'base.php' wrapper template
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_template_include' ) ) {
	function localup_template_include( $template ) {
		global $localup_content_template;
		$localup_content_template = $template;
		
		return get_template_directory() . '/base.php';
	}
}

add_filter( 'template_include', 'localup_template_include' );

/**
 *	Is categorized blog?
 *
 *	Determines if this blog/site has more than one category. Create your own
 *	localup_categorized_blog() function to override in the child theme.
 *	
 *	@return	boolean True if there is more than one category, otherwise False
 *	@since LocalUp 1.0
 */
if( ! function_exists( 'localup_categorized_blog' ) ) {
	function localup_categorized_blog() {
		$all_cats = get_transient( 'localup_categories' );
		
		if( false == $all_cats ) {
			$all_cats = get_categories( array(
				'fields'	=> 'ids',
				'number'	=> 2,
			) );
			
			$all_cats = count( $all_cats );
			
			set_transient( 'localup_categories', $all_cats );
		}
		
		return ( $all_cats > 1 );
	}
}

/**
 *	Flush category transients.
 *	
 *	Flushes the category transients used in the localup_categorized_blog() 
 *	function.
 *	
 *	@since SPOTY 1.0
 */
function localup_category_transient_flusher() {
	if( defined( DOING_AUTOSAVE ) && DOING_AUTOSAVE ) {
		return;
	}
	
	delete_transient( 'localup_categories' );
}

add_action( 'edit_category', 'localup_category_transient_flusher' );
add_action( 'save_post', 'localup_category_transient_flusher' );

/**
 *	Hex to RGB color conversion.
 *
 *	Converts and returns an array of RGB (red, green and blue) values from the
 *	given 3 or 6 digit hexadecimal color. 
 *	
 *	@param string $color Hexadecimal color value
 *	@return	array RGB color values or false for incorrect input.
 *	@since LocalUp 1.0
 */
function localup_hex2rgb( $color ) {
	$color = trim( '' . $color, '#' );
	
	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return false;
	}
	
	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 *	Returns the Google fonts URL for the theme.
 *	
 *	@return	string Google fonts URL
 *	@since LocalUp 1.0
 */
function localup_get_fonts_url() {
	$fonts_url = '';
	$fonts = apply_filters( 'spoty_fonts', array(
		'Muli:400,400italic',
		'Playfair Display:700',
		'Inconsolata',
	) );
	
	if( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	
	return $fonts_url;
}

/**
 *	Returns the Fontawesome URL for the theme.
 *	
 *	@return	string Fontawesome URL
 *	@since LocalUp 1.0
 */
function localup_get_icons_url() {
	return 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css';
}

/**
 *	Displays the site brand.
 *	
 *	@return	string Fontawesome URL
 *	@since LocalUp 1.0
 */
function localup_brand() {
	$site_name = get_bloginfo( 'name' );
	$logo = $site_name;
	
	$logo_image_id = absint( get_theme_mod( 'localup_logo', false ) );
	if( $logo_image_id ) {
		$logo_image = wp_get_attachment_image_src( $logo_image_id, 'full' );
		$logo = sprintf( '<img src="%1$s" alt="%2$s">', 
			esc_url( $logo_image[0] ), esc_attr( $site_name ) );
	}
	
	echo $logo;
}