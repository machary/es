	<footer>
		<?php if(of_get_option('footer_widgets', 'yes') == 'yes'): ?>
		<div class="width-container columns-<?php echo of_get_option('footer_cols', '4'); ?>">
				
			<?php
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 1')): 
			endif;
			?>

			<?php
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 2')): 
			endif;
			?>

			<?php
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 3')): 
			endif;
			?>

			<?php
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 4')): 
			endif;
			?>
			<div class="clearfix"></div>

		</div><!-- close .width-container -->
		<?php endif; ?>
		
		
		<div id="copyright">
			<div class="width-container">
				<span class="copyright-left">
				<?php echo of_get_option('copyright', '&copy; 2012 All Rights Reserved. Designed by <a href="http://progressionstudios.com/" target="_blank">Progression Studios</a>.'); ?>
				</span>
				<a href="#" id="scrollToTop">Scroll to top</a>
			<div class="clearfix"></div>
			</div><!-- close .width-container -->	
		</div><!-- close #copyright -->
		</div><!-- close .width-container -->
	</footer>

	<?php wp_footer(); ?>
	
	<?php if(of_get_option('tracking_code')): ?>
		<?php echo '<script type="text/javascript">'; ?>
		<?php echo of_get_option('tracking_code'); ?>
		<?php echo '</script>'; ?>
	<?php endif; ?>
	
</body>
</html><a href="http://www.wplocker.com">shared on wplocker.com</a>