<?php

namespace LandingDataApi;

const MID_TYPE_KEY = 'landingMidType';

class MidType
{
  const FOR_USER = "midForUserLanding";
  const FOR_APP = "midForAppLanding";
}

class FeeTypes
{
  const REFOUND = 2;
  const TRANSACTION = 7;
  const CHARGEBACK = 1;
}

function get_landing_data()
{
  static $cached_data = null;

  if ($cached_data !== null) {
    return $cached_data;
  }

  $LANDING_API_URL = 'SECRET';
  $response = wp_remote_get($LANDING_API_URL);

  if (is_array($response) && !is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $cached_data = json_decode($body);

    return $cached_data;
  }

  return array();
}

function get_mid_for_user()
{
  $data = get_landing_data();
  $index = array_search(MidType::FOR_USER, array_column($data->data, MID_TYPE_KEY));

  return $data->data[$index]->data;
}

function get_mid_for_app()
{
  $data = get_landing_data();
  $index = is_array($data->data) ? array_search(MidType::FOR_APP, array_column($data->data, MID_TYPE_KEY)) : [];

  return $data->data[$index]->data;
}
