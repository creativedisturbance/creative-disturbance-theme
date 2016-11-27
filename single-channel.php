<?php
/**
 * The template for single channels
 *
 * @package WordPress
 * @subpackage Creative Disturbance
 * @since Creative Disturbance 1.0
 */

get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
		?>
			
			<div id="channel-header">
				<h3>
					<b><?php the_title(); ?></b>
				</h3>
				<?php 
					#fetch the image for this channel	
					$image_id = get_post_meta(get_the_ID(), 'album_cover');
					#display the image
					#to change the size of the image, alter the array being passed (x,y)
					echo wp_get_attachment_image($image_id[0], array('380','380'));
				?>
			</div>

			<div id="channel-info">
				<div id="hosts">
					<span>Hosted by</span>
					<?php 
						#channel producers
						$i = 0;
						$authors = (get_post_meta(get_the_ID(), 'ChannelAuthor'));
						foreach ($authors as $author) {
							#output the list of producers, using commas if there is more than one
							echo $author;
							if($i>0){echo ', ';}
							$i++;
						}
					?> 
				</div>
				<div id="channel-about">
					<?php 
						#channel description
						echo get_post_meta(get_the_ID(), 'channeldesc')[0];
					?> 
				</div>
			</div>
		
			<hr>

			<div id="recent-podcasts">
				<h3><b>Recent Podcasts</b></h3>
				<?php 

					$podcast_loop = new WP_Query( array( 
				        'post_type' => 'podcast',
						'posts_per_page' => 4,
						'meta_key' => 'channel',
						'meta_value' => get_the_title()
					));

					#loop posts
					while ( $podcast_loop->have_posts() ) : $podcast_loop->the_post();
				?>

					<div class="podcast">
						<div class="row">
							<div class="col-sm-4 title">
								<a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a>
							</div>
							<div class="col-sm-8 voices">
								<?php 
									#get list of voices for each podcast and display as icons
									$voices = str_getcsv(str_replace(array("[", "]", "\""), "", get_post_meta(get_the_ID(), 'voices')[0]));
									foreach ($voices as $voice) {
										#split voice into first and last name
										$names = explode(" ", $voice);
										#fetch voice post
										$voice_loop = new WP_Query( array( 
									        'post_type' => 'people',
											'posts_per_page' => 1,
											'meta_query' => array(
													array(
														'key' => 'firstname',
														'value' => $names[0],
														'compare' => '='
													),
													array(
														'key' => 'lastname',
														'value' => $names[1],
														'compare' => '='
													)
												)
										));
										while ( $voice_loop->have_posts() ) : $voice_loop->the_post();
											#output for voices starts here
										?>
											<a class="voice" href="<?php echo get_permalink(get_the_ID()); ?>">
												<?php 
													#fetch the image for this channel	
													$image_id = get_post_meta(get_the_ID(), 'photo');
													#display the image
													#to change the size of the image, alter the array being passed (x,y)
													echo wp_get_attachment_image($image_id[0], array('100','100'));
												 ?>
											</a>												
	
										<?php endwhile;
									}
								?>
							</div>
						</div>
					</div>


				<?php endwhile; ?>
			</div>

		<?php
		// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
