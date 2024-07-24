<?php

namespace CurrencySelectFilter;

use CurrencyData;

function get_currency_option_template($label, $img_url, $prefix)
{
  $image_wrapper_style = 'border-radius: 50%;overflow: hidden;width: 30px;aspect-ratio: 1;';
  $image_style = 'width: 100%;height: 100%;object-fit: cover;';
  $prefix_style = 'color: lightgray; font-size: .7em;';
  $option_style = 'display: inline-flex;align-items: center;vertical-align: middle;padding-block: 5px; padding-left: 5px; gap: 10px;';

  $prefix = $prefix ? '<div style="' . $prefix_style . '">' . $prefix . '</div>' : '';
  $image = $img_url ? '<div style="' . $image_wrapper_style . '"><img style="' . $image_style . '" src="' . $img_url . '" alt="' . esc_attr($label) . '" /></div>' : '';

  return '<div style="' . $option_style . '">' . $image . $prefix . $label . '</div>';
}

function get_admin_currency_choices()
{
  $currencies = CurrencyData\get_currencies();
  $choices = array();

  foreach ($currencies as $data) {
    $prefix = $data->symbol . ' / ' . $data->currency;
    $option = get_currency_option_template($data->name, $data->flag, $prefix);

    $choices[$data->currency] = $option;
  }

  return $choices;
}

function set_admin_currency_choices($field)
{
  $field['type'] = 'select';
  $field["allow_null"] = 1;
  $field["multiple"] =  1;
  $field["ui"] = 1;
  $field['choices'] = get_admin_currency_choices();

  return $field;
}

add_filter('acf/load_field/name=currency_select', 'CurrencySelectFilter\set_admin_currency_choices');
