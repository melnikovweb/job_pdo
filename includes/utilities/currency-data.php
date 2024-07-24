<?php

namespace CurrencyData;

function get_currencies()
{
  static $cached_data = null;

  if ($cached_data !== null) {
    return $cached_data;
  }

  if (($raw_data = @file_get_contents(ABSPATH . 'SECRET')) === false) {
    $error = error_get_last();

    return ['error_message' => $error['message']];
  }

  $cached_data = json_decode($raw_data);

  return $cached_data;
}

function get_currency($key)
{
  $currencies = get_currencies();
  $key = array_search($key, array_column($currencies, 'currency'));

  return $currencies[$key];
}
