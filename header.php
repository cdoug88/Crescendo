<html <?php language_attributes(); ?>> 
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
		<link rel="stylesheet" type="text/css" href="https://citylinecreative.com/includes/css/animate.css" />
		<script src="https://citylinecreative.com/includes/js/wow.js"></script>q
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

		<script>
			var wow = new WOW().init();
		</script>
		<?php wp_head(); ?>
	</head> 
			  <div class="hero wide site-header" style="background: url('<?php 
if ( has_post_thumbnail() ) { 
	the_post_thumbnail_url();
} 
?>');background-position: center center;width: 100%; background-size: cover;">
	<header id="primary" class="primary wide">
		<?php
				if ( is_user_logged_in() ) {
				echo '
		<div class="admin-tool">
			<a class="logout" href="' . get_home_url() . '/dashboard"><i class="fas fa-home"></i></a>
			<a class="edit-post" href="' . get_edit_post_link() . '"><i class="fas fa-pencil-alt"></i></a>
			</div>
			';
				} 
			?>
		
	  <div class="container">
	    <div id="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home">
				<img src="/wp-content/themes/Crescendo/images/full-logo.svg" style="max-width: 290px;">
			</a>
	      </a>
	    </div>
	    <button id="menu" type="button" onclick="myFunction()">
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
<div class="thin-line">
	  </div>
	</header>
	
	
		
				

		
		
