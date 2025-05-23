<?php
namespace PotTheme\Admin\Pages\ThemeOptionsTemplate;
class FrontPageSelection
{
  public static function getPages(): array|bool
  {
    return get_pages();
  }

  public static function getSelectedPage(): string
  {
    return get_option('front_page_option', '');
  }

  public static function saveFrontPageSelection(): void
  {
    if (isset($_POST['front_page_option'])) {
      $selected_page = sanitize_text_field($_POST['front_page_option']);
      update_option('front_page_option', $selected_page);
      update_option('show_on_front', 'page');
      update_option('page_on_front', $selected_page);
    }
  }

  public static function templateOption(): void
  {

    $pages = self::getPages();
    $selected_page = self::getSelectedPage();

    ?>
    <!-- Front page selection -->
    <div class="flex flex-col gap-2">
      <div>
        <span class="text-lg"><?php echo __('Front Page', 'pot-theme'); ?></span>
      </div>
      <div class="flex flex-row justify-between items-center gap-20">
        <select name="front_page_option" id="front_page_option" class="w-full">
          <option value=""><?php echo __('-- Select a page --', 'pot-theme'); ?></option>
          <?php foreach ($pages as $page): ?>
            <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_page, $page->ID); ?>>
              <?php echo esc_html($page->post_title); ?>
            </option>
          <?php endforeach; ?>
        </select>

        <div class="description">
          <p class="text-base !m-0">
            <?php echo __('Select which page to display on your Frontpage. If left blank the Blog will be displayed. In case you do not see a select box - you have to publish pages.', 'pot-theme'); ?>
          </p>
        </div>
      </div>
    </div>
  <?php }
}