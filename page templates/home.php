<?php
/**
 * Template Name: Home
*/
get_header(); ?>



<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div id="header-img"><img src="/wp-content/uploads/2014/10/CD-Logo-English.png" alt=""></div>

		<div id="tagline">
			<div>
				Creative Disturbance is an international, multilingual network and podcast platform supporting collaboration among the arts, sciences, and new technologies communities. 
			</div>
			<a href="/about/">Learn More</a>			
		</div>

		<div class="row">
			<div class="col-sm-6">
				<h3><b>We Are a Growing Network</b></h3>
				<a href="/voices/">Join this collection of international thinkers, artists, scientists, innovators, writers, researchers, creators, philosophers and poets.</a>
			</div>
			<div class="col-sm-6">
				<h3><b>Podcast Disturbances</b></h3>
				<a href="/disturbances/">
					Here communities of thinkers are fostered and developed and as a product of this linking, unlikely connections emerge. One means of both sharing and spurring such interactions is through a dynamic collection of podcasts crowdsourced and produced by Creative Disturbance members.
				</a>
			</div>
		</div>
		
		<hr>
		
		<div class="row" id="recent-podcasts">
			<h3>Recent Podcasts</h3>
			
			<?php
			/*
			Get the six most recent podcasts to display
			*/

			#query database for posts
			$loop = new WP_Query( array( 
		        'post_type' => 'podcast',
		        'posts_per_page' => 6 ) );
			
			#track what post we're on
			$count = 0;

			#loop posts
			while ( $loop->have_posts() ) : $loop->the_post();
			?>
				<div class="col-sm-4 recent-podcast">
					<div class="channel-art">
						<?php 
							#fetch the image for this channel	
							$image_id = get_post_meta(get_the_ID(), 'episode_image');
							#display the image
							echo wp_get_attachment_image($image_id[0], array('380','380'));
						?>
					</div>
					<div class="title">
						<a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a>
					</div>
				</div>
				<?php 
					#check if we need to start a new row
					if($count == 2){
						echo "</div><div class='row'>";
					} 
					if($count == 5){
						echo "</div>";
					}
					$count++; 
				?>
			<?php
			endwhile;
			?>
		</div>

		<hr>

		<div id="join">
			<div class="row">
				<div class="col-sm-6">
					<h3>Become a Member</h3>
					<p>
						Join the world’s most unique connection of international thinkers, artists, scientists, innovators, writers, researchers, creators, philosophers and poets.
					</p>
				</div>
				<div class="col-sm-6">
					<h3>Subscribe to Our Newsletter</h3>
					<p>
						Keep up with Creative Disturbance news and announcements by subscribing to our email newsletter. You’ll be the first to know about new disturbances, voices, podcasts and more.
					</p>

				</div>
			</div>
			<br>
			<form id="mc-embedded-subscribe-form" class="validate" action="//creativedisturbance.us8.list-manage.com/subscribe/post?u=62ed54e8b9c4a51a8a5976659&amp;id=f90796f638" method="post" name="mc-embedded-subscribe-form" novalidate="" target="_blank">
				<div>
					<input id="mce-EMAIL" class="required email" style="height: 40px; width: 90%;" name="EMAIL" type="email" value="" placeholder="Subscribe to Our Newsletter" />
					<input id="mc-embedded-subscribe" class="vcex-newsletter-form-button" style="width: 9%; height: 41px;" name="subscribe" type="submit" value="Join" />
				</div>
			</form>
		</div>


		<div id="sponsors">
			<h3>Sponsors</h3>
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4"></div>
				<div class="col-sm-4"></div>
			</div>
		</div>

	</main>

	<?php get_sidebar( 'content-bottom' ); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
