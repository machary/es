<?php
// Template Name: Contact
get_header(); ?>
<?php
//If the form is submitted
if(isset($_POST['submit'])) {
	
	$comments = $_POST['message'];

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}


	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = get_post_meta($post->ID, 'pyre_email', true); //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nComments:\n $comments";
		$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, get_bloginfo('name'), $body, $headers);
		$emailSent = true;
	}
}
?>
	<div id="main">
		<div class="width-container">

			<div id="container-sidebar">
				<div class="content-boxed">
					<h2 class="title-bg"><?php the_title(); ?></h2>
					<?php if(get_post_meta($post->ID, "pyre_map", true)): ?>
					<div id="map-contact"></div>
					<script type="text/javascript"> 
					jQuery(document).ready(function($) {
					    $("#map-contact").goMap({ 
					        markers: [{  
					            address: '<?php echo get_post_meta($post->ID, "pyre_map", true); ?>', 
					            title: '<?php echo get_post_meta($post->ID, "pyre_map", true); ?>' ,
								icon: '<?php echo get_template_directory_uri(); ?>/images/pin.png'
							
					        }],
							disableDoubleClickZoom: true,
							zoom: 12,
							maptype: 'ROADMAP'
					    }); 

					});
					</script>
					<?php endif; ?>
					
					
					<?php while(have_posts()): the_post(); ?>
					<?php the_content(); ?>
						<?php endwhile; ?>

					<div id="contact-wrapper">
						<script type="text/javascript">
							jQuery(document).ready(function(){
								jQuery("#contactform").validate();
							});
						</script>


						<?php if(isset($hasError)) { //If errors are found ?>
							<p class="error"><?php _e('Please check if you have filled all the fields with valid information. Thank you.','progressionstudios'); ?></p>
						<?php } ?>

						<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
							<p class="success"><?php _e('Email Successfully Sent!','progressionstudios'); ?></p>
							<p class="success2"><?php _e('Thank you for using my contact form! I will be in touch with you soon.','progressionstudios'); ?></p>
						<?php } ?>

						<form method="post" action="<?php echo get_permalink(); ?>" id="contactform">
								<div><input type="text" size="28" name="contactname" id="contactname" value="" class="required" placeholder="<?php _e('Name','progressionstudios'); ?>*" /></div>

								<div><input type="text" size="28" name="email" id="email" value="" class="required email" placeholder="<?php _e('E-mail','progressionstudios'); ?>*" /></div>

								<div><textarea rows="12" cols="38" name="message" id="message" placeholder="<?php _e('Enter a message','progressionstudios'); ?>"></textarea></div>

								<div><input type="submit" value="<?php _e('Send Message','progressionstudios'); ?>" name="submit" class="submit" /></div>
						</form>

					</div><!-- close #contact-wrapper -->
					
				
					<div class="clearfix"></div>
				</div><!-- close .content-boxed -->
				
				
				<div class="clearfix"></div>
				
				
				
			</div><!-- close #container-sidebar -->

			<?php get_sidebar(); ?>
			
			
			
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>