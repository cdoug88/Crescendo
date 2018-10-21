	       	<?php get_header(); ?>
  <body <?php body_class(); ?>>
    <div id="mainContainer" class="main-container">
		<section id="content" role="main">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php comments_template(); ?>
			<?php endwhile; endif; ?>
			<?php get_template_part( 'nav', 'below' ); ?>
		</section>
      <!--- ADD HOME PAGE SECTIONS HERE --->
	  <?php get_footer(); ?>
    </div>
    <script>
		var navigation = (function() {
		  var el = $("navigation");
		  var button = $("menu");
		  var navOpen = false;
		  var ulHeight = function() {return el.down("ul").getHeight();};
		  var open = function() {
		    el.setStyle({height: ulHeight() + "px"}); 
		    el.addClassName("active"); 
		    button.addClassName("active");
		    navOpen = true;
		  };
		  var close = function() {
		    el.setStyle({height: 0 + "px"}); 
		    el.removeClassName("active"); 
		    button.removeClassName("active");
		    navOpen = false;
		  };
		  var events = (function() {
		    button.on("click", function(event,element){
		      navOpen == false ? open() : close();
		    });
		  }());
		  return {
		    open: open,
		    close: close
		  }
		}());
    </script>
  </body>
</html>