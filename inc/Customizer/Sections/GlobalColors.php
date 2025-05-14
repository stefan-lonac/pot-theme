<?php
/**
 * Global Colors Section
 * @package pot_theme
 * @subpackage Customizer
 */

namespace PotTheme\Customizer\Sections;

class GlobalColors
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
     * [Global Colors of the site]
     * Global colors of the site section.
     * This section is used to change the global colors of the site.
     */
    $wp_customize->add_section(
      'pot_theme_global_colors',
      array(
        'title' => __('Global Colors', 'pot-theme'),
        'priority' => $this->section_priority,
        'description' => __('Change global colors', 'pot-theme'),
        'panel' => 'pot_theme_main_section',
      )
    );

    $colors = [
      'primary_color' => [
        'label' => __('Primary Color', 'pot-theme'),
        'default' => '#0073aa',
      ],
      'secondary_color' => [
        'label' => __('Secondary Color', 'pot-theme'),
        'default' => '#555555',
      ],
      'accent_color' => [
        'label' => __('Accent Color', 'pot-theme'),
        'default' => '#d54e21',
      ],
      'background_color' => [
        'label' => __('Background Color', 'pot-theme'),
        'default' => '#ffffff',
      ],
    ];

    foreach ($colors as $id => $color) {
      $wp_customize->add_setting("pot_theme_{$id}", array(
        'default' => $color['default'],
        'sanitize_callback' => 'sanitize_hex_color',
      ));

      $wp_customize->add_control(
        new \WP_Customize_Color_Control(
          $wp_customize,
          "pot_theme_{$id}",
          array(
            'label' => $color['label'],
            'section' => 'pot_theme_global_colors',
            'settings' => "pot_theme_{$id}",
          )
        )
      );
    }
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
      'pot_theme_body_bg_color_control',
      array(
        'label' => __('Background color of the site', 'pot-theme'),
        'section' => 'pot_theme_body_section',
        'settings' => 'pot_theme_body_bg_color',
        'type' => 'color',
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
     * [Background color of the site]
     * This setting is used to set the background color of the site.
     */
    $wp_customize->add_setting('pot_theme_body_bg_color', array(
      'capability' => 'manage_options',
      'default' => '#fff',
      'sanitize_callback' => 'sanitize_hex_color',
    ));
  }

}