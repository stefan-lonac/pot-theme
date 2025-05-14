<?php
/**
 * Header Section
 * @package pot_theme
 * @subpackage Customizer
 */
namespace PotTheme\Customizer\Sections;
use WP_Customize_Color_Control;
class Header
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
     * [Header of the site]
     * Header of the site section.
     * This section is used to change the header appearance.
     */
    $wp_customize->add_section(
      'pot_theme_header_section',
      array(
        'title' => __('Site header', 'pot-theme'),
        'priority' => $this->section_priority,
        'description' => __('Change header appearance', 'pot-theme'),
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
     * [Background color of the site]
     * This setting is used to set the background color of the site.
     */
    $wp_customize->add_control(
      'pot_theme_header_color_control',
      array(
        'label' => __('Background color of header', 'pot-theme'),
        'section' => 'pot_theme_header_section',
        'settings' => 'pot_theme_header_bg_color',
        'type' => 'color',

      )
    );

  }

  private function add_setting_section($wp_customize): void
  {
    /* 
     * [Color Header of the site]
     * This setting is used to set the color of the header.
     */
    $wp_customize->add_setting(
      'pot_theme_header_bg_color',
      array(
        'capability' => 'manage_options',
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );
  }
}