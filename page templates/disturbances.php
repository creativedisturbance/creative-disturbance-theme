<?php
/**
 * Template Name: Disturbances
*/
get_header(); ?>



<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div class="row" id="recent-podcasts">
			<h3>Disturbances</h3>

			<?php
			/*
			Get the six most recent podcasts to display
			*/

			#query database for posts
			$channel_loop = new WP_Query( array( 
		        'post_type' => 'channel',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => -1
			));
			
			#track what post we're on
			$count = 1;

			#loop posts
			while ( $channel_loop->have_posts() ) : $channel_loop->the_post();
			?>
				<!--Channel-->
				<div class="col-sm-4 channel">
					
					<!--Artwork and Title-->
					<a href="<?php echo get_permalink(); ?>">
						<div class="channel-art">
							<?php 
								#fetch the image for this channel	
								$image_id = get_post_meta(get_the_ID(), 'album_cover');
								#display the image
								echo wp_get_attachment_image($image_id[0], array('300','300'));
							?>
						</div>
						<div class="title">
							<?php echo the_title(); ?>
						</div>
					</a>
				
					<!--Episodes-->
					<ul class="episodes">
						<?php 
							$episode_loop = new WP_Query(array(
								'post_type' => 'podcast',
								'posts_per_page' => 3,
								'meta_key' => 'channel',
								'meta_value' => get_the_title()
							));
							while ( $episode_loop->have_posts() ) : $episode_loop->the_post();
						?>
						
							<li class="episode">
								<?php echo the_title(); ?>
							</li>
			
						<?php 
							#end podcast loop
							endwhile; 
						?>
					</ul>
				</div> <!--End Channel-->	
				
				<?php 
					#check if we need to start a new row
					if($count%3 == 0){
						echo "</div><div class='row'>";
					} 
					$count++; 
				?>
			<?php 
				#end channel loop
				endwhile; 
			?>

	</main>

	<?php get_sidebar( 'content-bottom' ); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
