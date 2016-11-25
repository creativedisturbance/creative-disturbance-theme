<?php
/**
 * Template Name: Home
*/
get_header(); ?>



<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">


		<div id="header-img">	
				<img src="/wp-content/uploads/2014/10/CD-Logo-English.png" alt="">
		</div>

		<?php
		$loop = new WP_Query( array( 
	        'post_type' => 'podcast',
	        'posts_per_page' => 15 ) );

		while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<?php
		endwhile;
		?>

	</main>

	<?php get_sidebar( 'content-bottom' ); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
