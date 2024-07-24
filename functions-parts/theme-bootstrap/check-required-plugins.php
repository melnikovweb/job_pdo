<?php
require_once get_template_directory() . '/includes/class-required-plugins-checker.php';

$required_plugins = array(
  'advanced-custom-fields-pro/acf.php',
);

$required_plugins_checker = new RequiredPluginsChecker( $required_plugins );

add_action( 'template_redirect', array( $required_plugins_checker, 'check_required_plugins' ) );
add_action( 'admin_notices', array( $required_plugins_checker, 'check_required_plugins_admin_notice' ) );
