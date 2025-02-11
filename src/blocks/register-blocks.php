<?php

function my_theme_register_blocks()
{
  register_block_type_from_metadata(get_template_directory() . '/src/blocks/my-block/build/my-block');
}
add_action('init', 'my_theme_register_blocks');
