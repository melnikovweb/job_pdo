<?php
// Убираем лишние теги с форм Contact Form 7
// add_filter('wpcf7_form_elements', function ($content) {
//     $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
//     return $content;
// });

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('wpcf7_form_class_attr', 'custom_custom_form_class_attr');
function custom_custom_form_class_attr($class)
{
    $class .= ' contact-form';
    return $class;
}