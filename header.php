<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Isvek\Theme
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<!doctype html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset='<?php bloginfo( 'charset' ); ?>'/>
	<meta name='viewport' content='width=device-width, initial-scale=1'/>
	<meta http-equiv='x-ua-compatible' content='ie=edge'/>
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="container">
	<div class="row">
		<div class="col-12">
			<?php
			wp_nav_menu(
				[
					'theme_location' => 'header-nav-menu',
					'container'      => false,
					'menu_class'     => 'navbar navbar-expand-lg bg-body-tertiary mb-4',
				]
			);
			?>
		</div>
	</div>
</div>