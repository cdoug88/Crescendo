
<?php get_header(); ?>
<div class="tagline">
</div>
</div>
<section id="content" role="main">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<section class="entry-content">
					
					
					<div class="entry-links">
						<?php wp_link_pages(); ?>
					</div>
				</section>
			</article>
	<!-- 	<?php if ( ! post_password_required() ) comments_template( '', true ); ?> -->
		<?php endwhile; endif; ?>
<div class="black-bar">
</div>
</section>

<?php get_footer(); ?>
