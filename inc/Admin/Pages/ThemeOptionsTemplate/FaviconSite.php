<?php
namespace PotTheme\Admin\Pages\ThemeOptionsTemplate;
class FaviconSite
{

  public static function getFaviconSite(): string
  {
    return get_option('pt_favicon_logo_image');
  }

  public static function saveFaviconImage(): void
  {
    $image_favicon_id = absint($_POST['pt_favicon_img']);
    update_option('pt_favicon_logo_image', $image_favicon_id);
    update_option('site_icon', $image_favicon_id);
  }


  public static function templateOption(): void
  {
    $buttonPrimary = \PotTheme\Admin\Pages\ThemeOptions::getStyleComponents('buttonPrimary');
    $buttonRemove = \PotTheme\Admin\Pages\ThemeOptions::getStyleComponents('buttonRemove');
    $image_favicon_id = self::getFaviconSite();
    ?>

    <!-- Favicon Image -->
    <div class="flex flex-col gap-2 mt-5">
      <div>
        <span class="text-lg"><?php echo __('Favicon Image', 'pot-theme'); ?></span>
      </div>
      <div class="flex flex-row items-end gap-5">
        <?php
        if ($image_favicon = wp_get_attachment_image_url($image_favicon_id, 'thumbnail')): ?>
          <a href="#" class="pt-img-upload-favicon <?php !$image_favicon ? $buttonPrimary : ''; ?>">
            <img src=" <?php echo esc_url($image_favicon); ?>" />
          </a>
          <a href="#" class="pt-img-remove <?php echo $buttonRemove; ?>"><?php echo __('Remove favicon', 'pot-theme'); ?></a>
          <input type="hidden" name="pt_favicon_img" value="<?php echo absint($image_favicon_id); ?>">
        <?php else: ?>
          <a href="#"
            class="button pt-img-upload-favicon <?php echo $buttonPrimary; ?>"><?php echo __('Upload favicon', 'pot-theme'); ?></a>
          <a href="#" class="pt-img-remove <?php echo $buttonRemove; ?>"
            style="display:none"><?php echo __('Remove favicon', 'pot-theme'); ?></a>
          <input type="hidden" name="pt_favicon_img" value="">
          <p class="pt-favicon-error" style="color:red; display: none;">
            <?php echo __('Favicon must be at least 512x512 pixels.', 'pot-theme'); ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
  <?php }
}