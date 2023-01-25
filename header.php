<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package evn
 */

?>

<?php 

$var_class = '';

if (isset($args['is_homepage']) && $args['is_homepage'] === true) {
	$var_class .= 'homepage';
}

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title><?php wp_title();?></title>
	<?php wp_head(); ?>
</head>

<body>
<?php if (is_front_page()) : ?>
	<svg version="1.1" id="evnFilter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 460 220" preserveAspectRatio="xMidYMid keep">
		<defs>
		<filter id="titleFilter">
			<!-- COLORS -->
			<feFlood flood-color="#143C56" result="COLOR-accent"></feFlood>
			<!-- COLORS END -->

			<!-- STROKE -->
			<feMorphology operator="dilate" radius="1" in="SourceAlpha" result="STROKE_10"></feMorphology>
			<!-- STROKE END -->

			<!-- EXTRUDED BEVEL -->
			<feConvolveMatrix order="3,3" divisor="1" kernelMatrix="1 0 0 0 1 0 0 0 1" in="STROKE_10" result="BEVEL_20"></feConvolveMatrix>

			<feOffset dx="1" dy="2" in="BEVEL_20" result="BEVEL_25"></feOffset>
			<feComposite operator="out" in="BEVEL_25" in2="STROKE_10" result="BEVEL_30"></feComposite>
			<feComposite in="COLOR-accent" in2="BEVEL_30" operator="in" result="BEVEL_40"></feComposite>
			<feMerge result="BEVEL_50">
				<feMergeNode in="BEVEL_40"></feMergeNode>
				<feMergeNode in="SourceGraphic"></feMergeNode>
			</feMerge>
			<!-- EXTRUDED BEVEL END -->
		</filter>
		</defs>
	</svg>
<?php endif; ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'evn' ); ?></a>

	<header id="masthead" class="site-header content-wrap <?php echo $var_class; ?>">
		<div class="logo">
			<a href="<?php echo site_url();?>">
				<?php echo evn_logo_svg();?>
			</a>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'evn' ); ?></span><span class="nav-bar"></span><span class="nav-bar"></span><span class="nav-bar"></span></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' ,
					'walker' => new EVN_Menu_Walker()
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
