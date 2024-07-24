<?php

namespace CountryDataApi;

function get_raw_prohibited_countries_for_onboarding()
{
  static $cached_data = null;

  if ($cached_data !== null) {
    return $cached_data;
  }

  $API_URL = 'SECRET';
  $response = wp_remote_get($API_URL);

  if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $cached_data = json_decode($body)->data;

    return $cached_data;
  }

  return array();
}

function get_raw_prohibited_subdivisions()
{
  static $cached_data = null;

  if ($cached_data !== null) {
    return $cached_data;
  }

  $API_URL = 'SECRET';
  $response = wp_remote_get($API_URL);

  if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $cached_data = json_decode($body)->data;

    return $cached_data;
  }

  return array();
}

function get_all_countries()
{
  static $cached_data = null;

  if ($cached_data !== null) {
    return $cached_data;
  }

  $COUNTRIES_API_URL = 'SECRET';
  $response = wp_remote_get($COUNTRIES_API_URL);

  if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $countries = json_decode($body)->data;

    $cached_data = adapter_SECRET_to_site_country_data($countries);

    return $cached_data;
  }

  return array();
}

function get_countries($codes)
{
  $data = get_all_countries();

  $countries = array_filter($data, function ($value) use ($codes) {
    return in_array($value->cca2, $codes);
  });

  return array_values($countries);
}

function get_countries_region($countries)
{
  return array_reduce($countries, function ($map, $item) {
    $region = $item->region;

    if (array_key_exists($region, $map)) {
      array_push($map[$region], $item);

      return $map;
    }

    $map[$region] = array($item);

    return $map;
  }, array());
}

function get_all_available_countries()
{
  $prohibited_countries = get_raw_prohibited_countries_for_onboarding();

  $countries = get_all_countries();
  $codes = array_map(fn ($country) => $country->code, $prohibited_countries);
  $countries = array_filter(get_all_countries(), fn ($country) => !(in_array($country->cca2, $codes)));

  return array_values($countries);
}

function get_supported_countries($not_supported_countries)
{
  $prohibited_countries = get_raw_prohibited_countries_for_onboarding();

  $countries = get_all_countries();
  $codes = array_map(fn ($country) => $country->code, $prohibited_countries);
  $countries = array_filter(get_all_countries(), fn ($country) => !(in_array($country->cca2, $codes)));

  $sup_countries = array_filter($countries, fn ($country) => !(in_array($country->cca2, $not_supported_countries)));

  return get_countries_region(array_values($sup_countries));
}

function get_prohibited_countries_for_onboarding()
{
  $prohibited_countries = get_raw_prohibited_countries_for_onboarding();

  $codes = array_map(fn ($country) => $country->code, $prohibited_countries);

  return get_countries($codes);
}

function get_raw_prohibited_data_for_outgoing()
{
  static $cached_data = null;

  if ($cached_data !== null) {
    return $cached_data;
  }

  $API_URL = 'SECRET';
  $response = wp_remote_get($API_URL);

  if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $cached_data = json_decode($body)->data;

    return $cached_data;
  }

  return array();
}

function get_prohibited_subdivisions_for_outgoing()
{
  $prohibited_countries = get_raw_prohibited_data_for_outgoing();

  $subdivisions = $prohibited_countries->counterpartySubdivision;

  return subdivisions_api_v1_to_v2_adapter($subdivisions);
}

function subdivisions_api_v1_to_v2_adapter($data)
{
  $adapted_data = array_map(function ($subdivision) {
    return (object)[
      'name' => $subdivision->subdivision,
      'country' => (object)[
        'name' => $subdivision->country
      ]
    ];
  }, $data);
  return $adapted_data;
}

function adapter_SECRET_to_site_country_data($countries)
{
  $new_countries = $countries;
  $new_countries = array_map(function ($country) {
    $svg_flag_name = strtolower($country->alphaTwoCode);
    $svg_flag = "https://flagcdn.com/$svg_flag_name.svg";
    $fullName = ($country->fullName === '')
      ? $country->shortName
      : $country->fullName;
    return (object)[
      'name' => (object)[
        'official' => $fullName,
        'common' => $country->shortName
      ],
      'cca2' => $country->alphaTwoCode,
      'ccn3' => $country->numericCode,
      'flags' => (object)[
        'svg' => $svg_flag
      ],
      'region' => $country->regionName,
    ];
  }, $new_countries);
  return $new_countries;
}
