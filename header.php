<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pot_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'pot-theme'); ?></a>

		<header id="masthead" class="site-header">


			<div class="site-branding">
				<?php

				if (function_exists('the_custom_logo')):
					the_custom_logo();
				else:
					?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
					</p>
					<?php
				endif;
				$pot_theme_description = get_bloginfo('description', 'display');
				if ($pot_theme_description || is_customize_preview()):
					?>
					<p class="site-description"><?php echo $pot_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu"
					aria-expanded="false"><?php esc_html_e('Primary Menu', 'pot-theme'); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-primary',
						'menu_id' => 'primary-menu',
						'container' => 'nav',
						'container_class' => 'main-nav',
						'menu_class' => 'menu',
						'link_before' => '',
						'link_after' => '',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->