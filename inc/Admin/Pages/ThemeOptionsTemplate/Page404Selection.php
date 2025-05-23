<?php
namespace PotTheme\Admin\Pages\ThemeOptionsTemplate;
class Page404Selection
{
  public static function getPages(): array|bool
  {
    return get_pages();
  }

  public static function getSelectedPage(): string
  {
    return get_option('pt_404_page', '');
  }

  public static function savePage404Selection(): void
  {
    $selected_404_page = sanitize_text_field($_POST['pt_404_page']);
    update_option('pt_404_page', $selected_404_page);
  }

  public static function templateOption(): void
  {
    $pages_404 = self::getPages();
    $selected_404_page = self::getSelectedPage();
    ?>

    <div class="flex flex-col gap-2 mt-5">
      <div>
        <span class="text-lg"><?php echo __('Select 404 Page', 'pot-theme'); ?></span>
      </div>
      <div class="flex flex-row justify-between items-center gap-20">
        <select name="pt_404_page" id="pt_404_page" class="w-full">
          <option value=""><?php echo __('-- Select a 404 page --', 'pot-theme'); ?></option>
          <?php foreach ($pages_404 as $page): ?>
            <option value="<?php echo esc_attr($page->ID); ?>" <?php selected($selected_404_page, $page->ID); ?>>
              <?php echo esc_html($page->post_title); ?>
            </option>
          <?php endforeach; ?>
        </select>

        <div class="description">
          <p class="text-base !m-0">
            <?php echo __('Select if you want to use any of your pages as your custom Error 404 Page. This page will be excluded from page lists and search results. You must deselect the page to make it accessible for public again.', 'pot-theme'); ?>
          </p>
        </div>
      </div>
    </div>
  <?php }
}