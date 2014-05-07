
	</div><!-- #main -->

	<div id="footer">
		<div class="footer-column">
			<?php dynamic_sidebar('footer-column-a'); ?>
		</div>
		<div class="footer-column">
			<?php dynamic_sidebar('footer-column-b'); ?>
		</div>
		<div class="footer-column">
			<?php dynamic_sidebar('footer-column-c'); ?>
		</div>
		
		<div class="copyright"><p>&copy; <?php bloginfo('name');?> <?php echo date('Y');?> All rights reserved. <a href="http://www.slimtheme.com/lean">The Lean Theme</a> by <a href="http://zhiyan.de">DUAN Zhiyan</a></p>
			<?php
			$menu = array(
				'theme_location'  => 'Footer',
				'container'       => false,
				'menu_class'      => 'menu-footer',
				'menu_id'         => 'menu-footer',
				//'walker'          => new MainNavWalker(),
				'fallback_cb'     => '',
			);

			wp_nav_menu( $menu );
			?>
		</div>
	</div>
</div><!-- #wrap -->
<?php wp_footer();?>
</body>
</html>
