<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package evn
 */

?>

<div id="work-with-me" class="dialog-container" aria-label="<?php _e('Get in touch', 'evn');?>" 
	aria-hidden="true" data-a11y-dialog="contact_cta" class="dialog-container">
	<div data-a11y-dialog-hide class="dialog-overlay"></div>
	<button class="outline ribbon" type="button" title="Close sidebar" data-a11y-dialog-hide aria-label="Close sidebar">
		Work with me
		<?php echo evn_cta_arrow_svg();?>
	</button>
	<div role="document" class="dialog-content sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
  	</div>
</div>

<button class="cta ribbon" type="button" data-a11y-dialog-show="contact_cta">
  Work with me
  <?php echo evn_cta_arrow_svg();?>
</button>

</div><!-- #page -->

<footer id="colophon" class="site-footer content-wrap">
	<div class="footer-top">
		<div class="social-media">
			<a class="icon" href="https://linkedin.com/in/evanbuckiewicz" target="_blank" title="LinkedIN"><?php echo evn_svg_linkedin();?><span class="screen-reader-text">LinkedIN</span></a>
			<a class="icon" href="https://github.com/skysarwer" target="_blank" title="Github"><?php echo evn_svg_github();?><span class="screen-reader-text">Github</span></a>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="address">
			<p class="is-style-font-semibold"><?php echo evn_marker_svg();?> Located in Mile End,<br/>  Montreal, QC Canada</p> 
		</div>
		<div class="contact">
		<p><span class="is-style-font-bold"><?php echo evn_svg_mail();?> Email : </span><a href="mailto:contact@evan.works" title="Email contact@evan.works">contact@evan.works</a></p>
		<p><span class="is-style-font-bold"><?php echo evn_svg_phone();?>Phone : </span><a href="tel:4388303585">+1 (438) 830-3585</span></a>
		</div>
	</div>
</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
