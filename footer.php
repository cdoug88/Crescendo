<div class="clear">
	
</div>
</div>
	<footer id="footer" role="contentinfo">
		<div id="copyright">
			<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved. ', 'blankslate' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); echo sprintf('Website by CityLine Creative'); ?>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>

</body>
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
</html>
