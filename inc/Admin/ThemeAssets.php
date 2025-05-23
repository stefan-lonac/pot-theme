<?php
namespace PotTheme\Admin;
class ThemeAssets
{
  public $styleComponents = array(
    'buttonPrimary' => '!bg-blue-500 !border-blue-500 hover:!bg-blue-400 !text-white !p-2 !rounded-md',
    'buttonRemove' => '!text-red-400 hover:!text-white text-sm bg-white hover:bg-red-400 border !border-red-400 p-2 rounded-md'
  );

  public static function getStyleComponents($key)
  {
    $instance = new self();

    if (empty($key)) {
      return $instance->styleComponents;
    }

    if (!array_key_exists($key, $instance->styleComponents)) {
      return $instance->styleComponents;
    }

    return $instance->styleComponents[$key] ?? '';
  }
}