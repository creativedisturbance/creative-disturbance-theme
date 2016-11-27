<?php
/**
 * The template for single people (this is not a dating site)
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
			<div id="voice-header">
				<div id="name">
					<h3><b><?php the_title(); ?></b></h3>
				</div>
				<div id="photo">
					<?php 
						#fetch the image for this channel	
						$image_id = get_post_meta(get_the_ID(), 'photo');
						#display the image
						echo wp_get_attachment_image($image_id[0], array('250','250'));
					?>					
				</div>
			</div>
			<div class="voice-detail">
				<div class="detail">Expertise</div>
				<div class="value">
					<?php echo get_post_meta(get_the_ID(), 'expertise')[0]; ?>
				</div>
			</div>
			<div class="voice-detail">
				<div class="detail">Bio</div>
				<div class="value">
					<?php echo get_post_meta(get_the_ID(), 'bio')[0]; ?>
				</div>
			</div>
			<div class="voice-detail">
				<div class="detail">Email</div>
				<div class="value">
					<?php 
						$email = get_post_meta(get_the_ID(), 'Email')[0]; 
						if($email == ""){
							echo "<i>None provided</i>";
						}else{
							echo $email;
						}
					?>
				</div>
			</div>
			<div class="voice-detail">
				<div class="detail">Website</div>
				<div class="value">
					<a href="<?php echo get_post_meta(get_the_ID(), 'weburl')[0]; ?>"><?php echo get_post_meta(get_the_ID(), 'weburl')[0]; ?></a>
				</div>
			</div>
			<hr>
			<div id="channels">
				<h3><b>Featured Podcasts</b></h3>
				<br>
				<?php 
					#get list of podcasts this person has been a voice on
					$name = get_the_title();
					$voice_loop = new WP_Query( array( 
				        'post_type' => 'podcast',
						'posts_per_page' => -1,
						'meta_query' => array(
								array(
									'key' => 'voices',
									'value' => $name,
									'compare' => 'LIKE'
								),
						)
					));
					while ( $voice_loop->have_posts() ) : $voice_loop->the_post();
						#output for podcasts starts here
					?>
						<div class="row podcast">
							<div class="col-sm-1">
								<?php 
									#fetch the image for this channel	
									$image_id = get_post_meta(get_the_ID(), 'episode_image');
									#display the image
									echo wp_get_attachment_image($image_id[0], array('75','75'));
								?>	
							</div>
							<div class="col-sm-11">
								<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php  the_title(); ?></a>
							</div>
						</div>
					<?php endwhile;
				?>
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
