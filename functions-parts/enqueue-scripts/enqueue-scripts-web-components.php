<?php
add_action('wp_enqueue_scripts', 'enqueue_web_components');
function enqueue_web_components()
{
  Enqueue::component('accordion/accordion.js', []);
  Enqueue::component('filters-group/filters-group.js', []);
  Enqueue::component('tabs/tabs.js', []);
  Enqueue::component('text-clamp/text-clamp.js', []);
}
