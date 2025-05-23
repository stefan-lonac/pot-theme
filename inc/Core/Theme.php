<?php

namespace PotTheme\Core;
use PotTheme\Customizer\ThemeCustomizer;
use PotTheme\Styling\ThemeStyle;

class Theme
{

  private static $instance = null;
  private static $customizer;
  private static $theme_style;

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
      self::$customizer = ThemeCustomizer::get_instance();
    }
    return self::$instance;
  }


  public function __construct()
  {

  }

  /**
   * Theme init.
   */
  public function init(): void
  {
    // add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    add_action('after_setup_theme', array(self::$customizer, 'setup'));
    add_action('customize_register', array(self::$customizer, 'register'));


    add_action('after_setup_theme', function () {
      new \PotTheme\Admin\ThemeSettingsPage();
    });
  }


  /**
   * Setup theme features.
   */
  public function setup()
  {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
  }

  /**
   * Enqueue scripts and styles.
   */
  public function enqueue_scripts()
  {
    wp_enqueue_style('pot-theme-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_script('pot-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
  }
}