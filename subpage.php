<?php /* Template Name: Subpage */ ?>

	<?php get_header(); ?>
  <body <?php body_class(); ?>>
    <div id="mainContainer" class="main-container">
      <div class="site-header wide">
        <div class="hero wide" style="background-image: url('');">
	        
        </div>

      </div>

		<?php the_content(); ?>
		
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