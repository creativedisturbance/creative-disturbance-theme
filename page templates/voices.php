<?php
/**
 * Template Name: Voices
*/
get_header(); ?>



<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div class="row" id="recent-podcasts">
			<h3>Voices</h3>

			<div class="row">
				<?php
				#query database for posts
				$voice_loop = new WP_Query( array( 
			        'post_type' => 'people',
					'posts_per_page' => -1,
					'order' => 'ASC',
					'meta_key' => 'lastname',
					'orderby' => 'meta_value',
				));
				
				#track what post we're on
				$count = 1;

				#loop posts
				while ( $voice_loop->have_posts() ) : $voice_loop->the_post();
				?>
				<!-- Voice -->
				<div class="col-sm-3">
					<a class="voice" href="<?php echo get_permalink(); ?>">
						<div class="photo">
							<?php 
								#fetch the image for this channel	
								$image_id = get_post_meta(get_the_ID(), 'photo');
								#display the image
								echo wp_get_attachment_image($image_id[0], array('200','200'));
							?>
						</div>
						<div class="title">
							<?php echo the_title(); ?>
						</div>
						<div class="expertise">
							<?php 
								echo get_post_meta(get_the_ID(), 'expertise')[0];
							 ?>
						</div>
					</a>
				</div><!-- End Voice-->

				<?php 
					#check if we need to start a new row
					if($count%4 == 0){
						echo "</div><div class='row'>";
					} 
					$count++; 
				?>
			<?php 
				#end channel loop
				endwhile; 
			?>
		</div>
	</main>

	<?php get_sidebar( 'content-bottom' ); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
