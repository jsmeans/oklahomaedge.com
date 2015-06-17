		

		<footer>

		<hr>

		<div class="footer-button container">
			<p>Extra Info</p>

		</div>

			<div class="footer-slider">
			<div class="grid_12 container clearfix">
				<div class="grid_4 footer_left">
				<?php if(dynamic_sidebar('footer_left')): ?>
					<?php else: ?>

					<h4>Twitter</h4>
					<p></p>
				<?php endif; ?>


				</div>
				<div class="grid_4 footer_middle">
				<?php if(dynamic_sidebar('footer_middle')): ?>
					<?php else: ?>
					<h4>Facebook</h4>
					<?php endif; ?>
				</div>
				<div class="grid_4 omega right-footer">
				<?php if(dynamic_sidebar('footer_right')): ?>
					<?php else: ?>
					<h4>Contact</h4>
					<?php endif; ?>
				</div>
			</div>
			</div>
			<div class="footer-bottom">
			<div  class="container">

			<div id="copyright">
				<p>&copy;<?php echo date('Y'); ?> <a href="#"> - Wag-Edge</a></p>
			</div>

			<div id="studio42" class="grid_4 omega">
	        		<a href="http://www.studio-42.com">Site Design and Development by Studio 42</a>
	        </div>
	        </div>

			</div>
		</footer>

		<?php wp_footer(); ?>
		
   
	</body>
</html>

