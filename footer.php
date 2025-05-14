<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pot_theme
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<a href="<?php echo esc_url(__('https://wordpress.org/', 'pot-theme')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'pot-theme'), 'WordPress');
			?>
		</a>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Theme: %1$s by %2$s.', 'pot-theme'), 'pot-theme', '<a href="http://underscores.me/">Underscores.me</a>');
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>


<style>
	/* Custom styles for the theme */
	body .site {
		background-color:
			<?php echo esc_attr(get_theme_mod('pot_theme_body_bg_color', '#fff')); ?>
	}

	body .site-main {
		max-width:
			<?php echo esc_attr(get_theme_mod('pot_theme_body_width_setting', '1200')) . 'px;'; ?>
		;
		width: 100%;
		margin: 0 auto;
	}
</style>

</body>

</html>