<?php
/**
 * Pot theme styling.
 *
 * @link 
 *
 * @package pot_theme
 */
namespace PotTheme\Styling;

class ThemeStyle
{
  public function __construct()
  {
    /**
     * Output global color variables in the head section
     */
    add_action('wp_head', array($this, 'output_global_color_variables'));
    add_action('wp_enqueue_scripts', array($this, 'pot_theme_scripts'));

  }

  public function pot_theme_scripts()
  {
    wp_enqueue_style('pot-theme-customize-color-picker-style', get_template_directory_uri() . '/inc/Customizer/assets/css/customize-color.css', array(), _S_VERSION);
    wp_enqueue_script(
      'pot-theme-customize-color',
      get_template_directory_uri() . '/inc/Customizer/assets/js/customize-color.js',
      array('customize-controls', 'jquery'),
      '1.0.0',
      true
    );
  }

  public function output_global_color_variables(): void
  {
    $color = [
      'primary' => get_theme_mod('pot_theme_primary_color', '#0073aa'),
      'secondary' => get_theme_mod('pot_theme_secondary_color', '#005177'),
      'accent-color' => get_theme_mod('pot_theme_accent_color', '#0073aa'),
      'background-color' => get_theme_mod('pot_theme_background_color', '#ffffff'),
    ];

    echo '<style type="text/css">:root {';
    foreach ($color as $key => $value) {
      echo "--{$key}: {$value};";
    }
    echo '}</style>';
  }
}