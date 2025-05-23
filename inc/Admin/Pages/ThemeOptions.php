<?php

/**
 * Theme Options Page
 * @package pot_theme
 * @subpackage Admin
 */
namespace PotTheme\Admin\Pages;
use PotTheme\Admin\ThemeAssets;

class ThemeOptions
{
  private static $instance = null;

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Get style components
   */
  public static function getStyleComponents($key)
  {
    return ThemeAssets::getStyleComponents($key);
  }

  /**
   * Add theme options page to the admin menu
   */
  public function registerAdminOptionsPageScripts()
  {
    add_action('admin_enqueue_scripts', array($this, 'adminOptionsPageScripts'));
  }

  /**
   * Enqueue scripts and styles for the theme settings page
   */
  public function adminOptionsPageScripts($hook)
  {
    if ($hook !== 'toplevel_page_pot-theme-settings') {
      return;
    }

    if (!isset($_GET['tab']) || $_GET['tab'] !== 'theme_options') {
      return;
    }

    // Enqueue scripts and styles for the theme options page
    if (!did_action('wp_enqueue_media')) {
      wp_enqueue_media();
    }

    wp_enqueue_script('pot-theme-admin-options-page-script', get_template_directory_uri() . '/inc/Admin/assets/js/admin-options.js', array('jquery'), _S_VERSION, true);
    wp_localize_script(
      'pot-theme-admin-options-page-script',
      'ptStyleComponents',
      \PotTheme\Admin\Pages\ThemeOptions::getStyleComponents('')
    );

    wp_enqueue_style('pot-theme-admin-options-page-style', get_template_directory_uri() . '/inc/Admin/assets/css/admin-options.css', array(), _S_VERSION);

  }

  /**
   * Add theme options page to the admin menu
   */
  public function displayThemeOptionsPage()
  {


    if (!current_user_can('manage_options')) {
      return;
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      check_admin_referer('pt_options_save', 'pt_options_nonce');

      $handlers = [
        'front_page_option' => [ThemeOptionsTemplate\FrontPageSelection::class, 'saveFrontPageSelection'],
        'pt_logo_img' => [ThemeOptionsTemplate\LogoSite::class, 'saveLogoImage'],
        'pt_favicon_img' => [ThemeOptionsTemplate\FaviconSite::class, 'saveFaviconImage'],
        'pt_404_page' => [ThemeOptionsTemplate\Page404Selection::class, 'savePage404Selection'],
      ];

      foreach ($handlers as $key => [$class, $method]) {
        if (isset($_POST[$key]) && is_callable([$class, $method])) {
          call_user_func([$class, $method]);
        }
      }
      echo '<div class="updated"><p>Settings saved.</p></div>';
    }


    ?>
    <div class="wrap w-5xl bg-white p-8 rounded-lg shadow-md">
      <div class="border-b border-gray-200 mb-4">
        <h1 class="!mb-[10px]"><?php echo __('Theme Options', 'pot-theme'); ?></h1>
      </div>
      <form method="post" enctype="multipart/form-data">
        <?php wp_nonce_field('pt_options_save', 'pt_options_nonce'); ?>

        <?php
        // Front page
        ThemeOptionsTemplate\FrontPageSelection::templateOption();

        // Logo site
        ThemeOptionsTemplate\LogoSite::templateOption();

        // Favicon site
        ThemeOptionsTemplate\FaviconSite::templateOption();

        // 404 page
        ThemeOptionsTemplate\Page404Selection::templateOption();
        ?>

        <?php submit_button('Save Changes'); ?>
      </form>
    </div>
    <?php
  }
}