<?php
add_filter('wp_terms_checklist_args', function ($config) {
  $config['checked_ontop'] = false;
  return $config;
});
