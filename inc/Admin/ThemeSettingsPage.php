<?php

namespace PotTheme\Admin;
use PotTheme\Admin\Pages\ThemeOptions;
class ThemeSettingsPage
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
   * Add theme settings page to the admin menu
   */
  public function __construct()
  {
    add_action('admin_menu', array($this, 'addThemeSettingsPage'));
    add_action('admin_enqueue_scripts', array($this, 'adminSettingsScripts'));

    ThemeOptions::getInstance()->registerAdminOptionsPageScripts();
  }


  /**
   * Enqueue scripts and styles for the theme settings page
   */
  public function adminSettingsScripts($hook)
  {
    if ($hook !== 'toplevel_page_pot-theme-settings') {
      return;
    }

    wp_enqueue_style('pot-theme-admin-settings-style', get_template_directory_uri() . '/inc/Admin/assets/css/admin-settings.css', array(), _S_VERSION);
    wp_enqueue_style('pot-theme-style-tailwind', get_template_directory_uri() . '/style-tailwind.css', array(), _S_VERSION);

  }

  public function addThemeSettingsPage()
  {
    add_menu_page(
      page_title: __('Pot Settings', 'pot-theme'),
      menu_title: __('Pot Settings', 'pot-theme'),
      capability: 'manage_options',
      menu_slug: 'pot-theme-settings',
      callback: array($this, 'renderThemeSettingsPage'),
      icon_url: 'dashicons-admin-generic',
      position: 100
    );
  }

  public function renderThemeSettingsPage()
  {
    $active_tab = $_GET['tab'] ?? 'theme_options';

    $settings_tabs_pages = array(
      'theme_options' => __(text: 'Theme Options', domain: 'pot-theme'),
      'general_styling' => __(text: 'General Styling', domain: 'pot-theme'),
      'header' => __(text: 'Header', domain: 'pot-theme'),
      'sidebar' => __(text: 'Sidebar Settings', domain: 'pot-theme'),
      'footer' => __(text: 'Footer', domain: 'pot-theme'),
    );

    ?>
    <div class="wrap">
      <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

      <div class="nav-tab-wrapper">
        <?php
        foreach ($settings_tabs_pages as $tab => $name):
          $active_class = $active_tab === $tab ? 'nav-tab-active' : '';
          ?>
          <a href="?page=pot-theme-settings&tab=<?php echo esc_attr($tab); ?>"
            class="nav-tab <?php echo esc_attr($active_class); ?>"> <?php echo esc_html($name); ?></a>
        <?php endforeach; ?>

      </div>

      <div class="pot-theme-settings-tab-content">
        <?php

        switch ($active_tab) {
          case 'theme_options':
            ThemeOptions::getInstance()->displayThemeOptionsPage();
            break;
          case 'general_styling':
            echo '<p>Ovde će biti General Styling podešavanja.</p>';
            break;
          case 'header':
            echo '<p>Ovde će biti Header podešavanja.</p>';
            break;
          case 'sidebar':
            echo '<p>Ovde će biti Sidebar Settings podešavanja.</p>';
            break;
          case 'footer':
            echo '<p>Ovde će biti Footer podešavanja.</p>';
            break;
        }
        ?>
      </div>
    </div>
    <?php
  }
}