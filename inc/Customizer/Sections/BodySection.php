<?php
/**
 * Body Section
 * @package pot_theme
 * @subpackage Customizer
 */

namespace PotTheme\Customizer\Sections;

class BodySection
{

  private int $section_priority;

  public function __construct(int $sectionPriority)
  {
    $this->section_priority = $sectionPriority;
  }

  /**
   * Register customizer settings and controls
   *
   * @param WP_Customize_Manager $wp_customize
   */
  public function register($wp_customize): void
  {
    // Add your customizer settings and controls here
    $this->add_general_section($wp_customize);
    $this->add_setting_section($wp_customize);
    $this->add_control_section($wp_customize);
  }

  /**
   * Summary of add_general_section
   * @param \PotTheme\Customizer\WP_Customize_Manager $wp_customize
   * @return void
   */
  private function add_general_section($wp_customize): void
  {

    /*
     * [Body of the site]
     * Body of the site section.
     * This section is used to change the body appearance.
     */
    $wp_customize->add_section(
      'pot_theme_body_section',
      array(
        'title' => __('Site body', 'pot-theme'),
        'priority' => $this->section_priority,
        'description' => __('Change body appearance', 'pot-theme'),
        'panel' => 'pot_theme_main_section',
      )
    );
  }

  /**
   * Summary of add_control_section
   * @param \PotTheme\Customizer\WP_Customize_Manager $wp_customize
   * @return void
   */
  private function add_control_section($wp_customize): void
  {
    /*
     * [Width of the site]
     * This setting is used to set the width of the site in pixels.
     */
    $wp_customize->add_control(
      'pot_theme_body_width',
      array(
        'label' => __('Width of the site', 'pot-theme'),
        'section' => 'pot_theme_body_section',
        'settings' => 'pot_theme_body_width_setting',
        'type' => 'number',
        'input_attrs' => array(
          'min' => 100,
          'step' => 1,
        ),
      )
    );
  }


  /**
   * Summary of add_setting_section
   * @param \PotTheme\Customizer\WP_Customize_Manager $wp_customize
   * @return void
   */
  private function add_setting_section($wp_customize): void
  {
    /*
     * [Width of the site]
     * This setting is used to set the width of the site in pixels.
     */
    $wp_customize->add_setting(
      'pot_theme_body_width_setting',
      array(
        'default' => '1000',
        'sanitize_callback' => 'absint',
      )
    );
  }

}