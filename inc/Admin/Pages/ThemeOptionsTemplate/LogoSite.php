<?php
namespace PotTheme\Admin\Pages\ThemeOptionsTemplate;
class LogoSite
{

  public static function getLogoSiteImage(): string
  {
    return get_option('pt_logo_image');
  }


  public static function saveLogoImage(): void
  {
    $image_id = absint($_POST['pt_logo_img']);
    update_option('pt_logo_image', $image_id);
    set_theme_mod('custom_logo', $image_id);

  }


  public static function templateOption(): void
  {
    $buttonPrimary = \PotTheme\Admin\Pages\ThemeOptions::getStyleComponents('buttonPrimary');
    $buttonRemove = \PotTheme\Admin\Pages\ThemeOptions::getStyleComponents('buttonRemove');
    $image_id = self::getLogoSiteImage();
    ?>

    <!-- Logo Image -->
    <div class="flex flex-col gap-2 mt-5">

      <div><span class="text-lg"><?php echo __('Logo Image', 'pot-theme'); ?></span></div>
      <div class="flex flex-row items-end gap-5">
        <?php if ($image = wp_get_attachment_image_url($image_id, 'medium')): ?>
          <a href="#" class="pt-img-upload">
            <img src="<?php echo esc_url($image); ?>" class="w-[150px] height-[150px]" />
          </a>

          <a href="#" class="pt-img-remove <?php echo $buttonRemove; ?>"><?php echo __('Remove logo', 'pot-theme'); ?></a>
          <input type="hidden" name="pt_logo_img" value="<?php echo absint($image_id); ?>">
        <?php else: ?>
          <a href="#"
            class="button pt-img-upload <?php echo $buttonPrimary; ?>"><?php echo __('Upload logo', 'pot-theme'); ?></a>
          <a href="#" class="pt-img-remove <?php echo $buttonRemove; ?>"
            style="display:none"><?php echo __('Remove logo', 'pot-theme'); ?></a>
          <input type="hidden" name="pt_logo_img" value="">
        <?php endif; ?>
      </div>
    </div>
  <?php }
}