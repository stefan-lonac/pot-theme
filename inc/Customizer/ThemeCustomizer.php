<?php
/**
 * Pot theme customizer and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pot_theme
 */
namespace PotTheme\Customizer;

use PotTheme\Customizer\Sections\BodySection;
use PotTheme\Customizer\Sections\GlobalColors;
use PotTheme\Customizer\Sections\Header;

class ThemeCustomizer
{
  private static $instance = null;

  public static function get_instance(): ThemeCustomizer
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Register customizer settings and controls
   *
   * @param WP_Customize_Manager $wp_customize
   */
  public function register($wp_customize): void
  {
    // Add your customizer settings and controls here
    $this->add_min_panel($wp_customize);

    $sections = [
      new Header(sectionPriority: 1),
      new BodySection(sectionPriority: 2),
      new GlobalColors(sectionPriority: 3),
    ];

    foreach ($sections as $section) {
      $section->register($wp_customize);
    }
  }

  public function setup(): void
  {
    add_action('customize_register', array($this, 'register'));
    // add_action('customize_preview_init', array($this, 'enqueue_preview_js'));
  }

  /**
   * Summary of add_min_panel
   * @param \PotTheme\Customizer\WP_Customize_Manager $wp_customize
   * @return void
   */
  private function add_min_panel($wp_customize): void
  {
    // Main section for the theme.
    $wp_customize->add_panel(
      'pot_theme_main_section',
      array(
        'title' => __('Pot theme', 'pot-theme'),
        'priority' => 1,
        'description' => __('Main settings for the theme.', 'pot-theme'),
      )
    );
  }
}