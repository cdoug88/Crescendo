
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

