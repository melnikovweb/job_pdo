<?php
class RequiredPluginsChecker
{
  private $required_plugins = array();

  public function __construct($plugins)
  {
    $this->required_plugins = $plugins;
  }

  public function is_plugin_active_custom($plugin)
  {
    return in_array($plugin, (array) get_option('active_plugins', array()));
  }

  private function get_missing_plugins()
  {
    $missing_plugins = array();

    foreach ($this->required_plugins as $plugin) {
      if (!$this->is_plugin_active_custom($plugin)) {
        $missing_plugins[] = $plugin;
      }
    }

    return $missing_plugins;
  }

  public function check_required_plugins()
  {
    $missing_plugins = $this->get_missing_plugins();

    if (!empty($missing_plugins)) {
      $missing_plugins_list = implode(', ', $missing_plugins);
      $message = __('For this template you need to install and activate the plugins: ', 'SECRET-domain') . $missing_plugins_list;
      wp_die($message);
    }
  }

  public function check_required_plugins_admin_notice()
  {
    $missing_plugins = $this->get_missing_plugins();

    if (!empty($missing_plugins)) {
      $missing_plugins_list = implode(', ', $missing_plugins);
      $message = __('For this template you need to install and activate the plugins: ', 'SECRET-domain') . $missing_plugins_list;
      echo '<div class="notice notice-error"><p>' . $message . '</p></div>';
    }
  }
}
