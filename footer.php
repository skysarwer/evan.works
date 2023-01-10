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
