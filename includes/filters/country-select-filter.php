<?php

namespace CountrySelectFilter;

use CountryDataApi;

function get_country_option_template($label, $img_url)
{
  $image = $img_url ? '<img style="width: 30px;aspect-ratio: 2/1;object-fit: contain;" src="' . $img_url . '" alt="' . esc_attr($label) . '" />' : '';
  return '<div style="display: inline-flex;vertical-align: middle;padding-block: 5px; padding-left: 5px; gap: 10px;">' . $image . $label . '</div>';
}

function get_admin_country_choices()
{
  $countries = CountryDataApi\get_all_countries();
  $choices = array();

  foreach ($countries as $item) {
    $key = $item->cca2;
    $value = get_country_option_template($item->name->common, $item->flags->svg);

    $choices[$key] = $value;
  }

  return $choices;
}

function set_admin_country_choices($field)
{
  $field['type'] = 'select';
  $field["allow_null"] = 1;
  $field["multiple"] =  1;
  $field["ui"] = 1;
  $field['choices'] = get_admin_country_choices();
  return $field;
}

add_filter('acf/load_field/name=country_select', 'CountrySelectFilter\set_admin_country_choices');
