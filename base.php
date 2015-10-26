<?php
/**
 *	Base template
 *	
 *	The default wrapper template to wrap all WordPress content templates. See
 *	localup_template_include() for implementation details.
 *
 *	@package localup
 *	@since LocalUp 1.0
 *	----------------------------------------------------------------------------
 */ ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="site-header" class="wrapper" role="banner">
		<div class="container clr">
			<div id="brand" class="col-xs-12 col-md-4">
				<h2>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
					   rel="home"><?php localup_brand();?></a>
				</h2>
			</div>
			
			<nav id="nav-menu" class="col-xs-12 col-md-8" role="navigation">
				<a href="#" class="toggle"><i class="fa fa-bars"></i></a>

				<?php
				wp_nav_menu( array(
					'container' 	 => false,
					'depth' 	 	 => -1,
					'theme_location' => 'localup_nav_menu',
				) ); ?>
			</nav>
		</div>
	</header>
	
	<?php
	if( is_active_sidebar( 'localup_hero_widgets' ) ) { ?>
	<div id="hero-widgets">
		<?php dynamic_sidebar( 'localup_hero_widgets' ); ?>
	</div> <?php
	} ?>
			
	<div id="site-content">
		<div class="container clr">
			<?php
			get_template_part( 'inc/page', 'header' );
			
			$show_sidebar = false;
			$main_class = 'col-xs-12';
			
			if( ! is_404() &&
				! is_page_template() &&
				is_active_sidebar( 'localup_sidebar_widgets' ) ) {
				$show_sidebar = true;
				$main_class .= ' col-md-8';
			} ?>
			
			<div id="main" class="<?php echo $main_class; ?>" role="main">
				<?php load_template( $localup_content_template ); ?>
			</div>
			
			<?php
			if( $show_sidebar ) { ?>
			<div id="sidebar" class="col-xs-12 col-md-4" role="complementary">
				<?php dynamic_sidebar( 'localup_sidebar_widgets' ); ?>
			</div> <?php
			} ?>
		</div>
	</div>
	
	<?php
	if( is_active_sidebar( 'localup_footer_widgets' ) ) { ?>
	<div id="hero-widgets">
		<?php dynamic_sidebar( 'localup_footer_widgets' ); ?>
	</div> <?php
	} ?>
	
	<footer id="site-footer" role="contentinfo">
		<div class="container clr">
			<span id="copyright">
				&copy; <?php echo Date( 'Y' ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
				   rel="home"><?php bloginfo( 'name' );?></a>
			</span>
			
			<span id="generator">
				Powered by
				<a href="http://wordpress.org/" rel="generator">WordPress</a>
			</span>
			
			<span id="designer">
				Designed by
				<a href="http://localup.in/" rel="designer">Localup</a>
			</span>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
</body>
</html>