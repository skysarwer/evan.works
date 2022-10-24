<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package evn
 */

 
if (is_front_page()) {
/*
$local_time = current_time('timestamp');

$appts = booked_appointments_available(date_i18n('Y',$local_time), false, false, false, true);
var_dump($appts);

$appts2 = booked_appointments_available(date_i18n('Y',$local_time), (date_i18n('m',$local_time) + 01), false, false, true);
var_dump($appts2);
$counter = 0;
exit;*/
	get_header('', array('is_homepage' => true));
	$var_class = 'homepage';
} else {
	get_header();
	$var_class = '';
}
?>	
	<?php if (is_front_page()) {
		evn_do_homepage_hero();
	}?>
	
	<main id="primary" class="<?php echo $var_class;?>">
		<div class="content-wrap">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>
	</main><!-- #main -->
<?php
//get_sidebar();
get_footer();
