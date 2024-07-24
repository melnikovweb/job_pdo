<?php
add_action('wpcf7_before_send_mail', 'zendesk_integration_contact_form7', 10, 3);

function zendesk_integration_contact_form7($contact_form, &$abort, &$submission) {
  $options = get_field('zendesk_integration', 'options');
  $contact_form7_ids = isset($options['contact_form7_ids']) ? $options['contact_form7_ids'] : [];
  $api_token = isset($options['api_token']) ? $options['api_token'] : '';

  if (!empty($contact_form7_ids) && !empty($api_token) && in_array($contact_form->id(), $contact_form7_ids)) {
    $posted_data = $submission->get_posted_data();
    $turnoverVolume = $posted_data['turnover-volume'] ?? '';
    $industry = $posted_data['industry'] ?? [];
    $userName = $posted_data['userName'] ?? '';
    $country = $posted_data['country'] ?? [];
    $website = $posted_data['website'] ?? '';
    $nameParts = explode(' ', $userName);

    if (count($nameParts) > 1) {
      $first_name = $nameParts[0];
      $last_name = implode(' ', array_slice($nameParts, 1));
    } else {
      $first_name = $userName;
      $last_name = "No last name";
    }

    if (empty($last_name)) {
      $last_name = "No last name";
    }

    $description = $posted_data['userMessage'] ?? '';

    if (!empty($industry)) {
      $description .= ' Industry: ' . implode('', $industry) . ';';
    }

    if (!empty($turnoverVolume)) {
      $description .= ' Projected monthly turnover volume: ' . $turnoverVolume . ';';
    }

    if (!empty($website)) {
      $description .= ' Website: ' . $website . ';';
    }

    $page_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No URL available';
    $description .= ' Submitted from: ' . $page_url . ';';

    $api_data = array(
      "data" => array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $posted_data['userEmail'] ?? '',
        "description" => $description,
        "address" => array(
          "country" => implode('', $country),
        ),
      ),
    );

    $api_url = 'https://api.getbase.com/v2/leads';
    $response = wp_remote_request($api_url, array(
      'method' => 'POST',
      'headers' => array(
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $api_token,
      ),
      'body' => json_encode($api_data),
    ));

    if (is_wp_error($response)) {
      error_log('Error: ' . $response->get_error_message());
    } else {
      $http_code = wp_remote_retrieve_response_code($response);
      $response_body = wp_remote_retrieve_body($response);
    }
  }
}
