<?php

class Enqueue
{

  const STYLE_PATH = '/assets/styles/';
  const SCRIPT_PATH = '/assets/js/';
  const WEB_COMPONENTS_PATH = '/public/components/';

  public $name;
  private static $styleQueue = [];

  public function __construct($name)
  {
    $this->name = $name;
  }

  public static function style($path, $options = [])
  {
    $name = 'SECRET-' . ($options['name'] ?? basename($path, '.css')) . '-style';
    $deps =  $options['deps'] ?? [];

    $is_root_path = $options['is_root_path'] ?? false;

    if (!in_array($name, self::$styleQueue)) {
      array_push(self::$styleQueue, $name);
      $style_content = "<style id=" . $name . ">" . file_get_contents(get_template_directory() . ($is_root_path ? '/' : self::STYLE_PATH) . $path) . "</style>";
      echo $style_content;
    }
  }

  public static function script($path, $dependencies = [], $options = [])
  {
    $name = 'SECRET-' . basename($path, '.js') . '-script';

    $is_root_path = $options['is_root_path'] ?? false;

    if (!wp_script_is($name)) {
      wp_enqueue_script($name, get_template_directory_uri() . ($is_root_path ? '/' : self::SCRIPT_PATH) . $path, $dependencies, _S_VERSION, true);
    }

    return new static($name);
  }

  public static function component($path, $dependencies = [], $options = [])
  {
    $name = 'SECRET-' . basename($path, '.js') . '-script';

    $is_root_path = $options['is_root_path'] ?? false;

    if (!wp_script_is($name)) {
      wp_enqueue_script($name, get_template_directory_uri() . ($is_root_path ? '/' : self::WEB_COMPONENTS_PATH) . $path, $dependencies, _S_VERSION, true);
    }

    return new static($name);
  }

  public static function register($name, $path, $deps = [], $version = _S_VERSION, $is_footer = true)
  {
    wp_register_script($name, get_template_directory_uri() . $path, $deps, $version, $is_footer);
  }

  public function localize($fieldName, $data)
  {
    wp_localize_script($this->name, $fieldName, $data);
  }
}
