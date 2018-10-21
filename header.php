<html <?php language_attributes(); ?>> 
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
		<?php wp_head(); ?>
	</head> 
			  <div class="hero wide site-header" style="background: url('<?php 
if ( has_post_thumbnail() ) { 
	the_post_thumbnail_url();
} 
?>');background-position: center center;width: 100%; background-size: cover;">
	<header id="primary" class="primary wide">
	  <div class="container">
	    <div id="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home">
				<img src="/images/layouts/logo.png">
			</a>
	      </a>
	    </div>
	    <button id="menu" type="button">
	      <span class="menu-bars">
	        <span class="menu-bar"></span>
	      </span>
	    </button>
	    <nav id="menu navigation" role="navigation" class="navigation">
	<!--
						<div id="search">
							<?php get_search_form(); ?>
						</div>
	-->
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
		</nav>
	  </div>

	</header>

	  </div>	
		
				

		
		