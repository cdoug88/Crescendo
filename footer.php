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
function myFunction() {

  if ($('.navigation').css('height') == '0px'){
    $(".navigation").css('height', 'auto');
  } else {
     $(".navigation").css('height', '0px');
  }
}
    </script>
</html>
