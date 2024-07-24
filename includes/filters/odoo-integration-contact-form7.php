<?php
add_action('wpcf7_before_send_mail', 'odoo_integration_contact_form7', 10, 3);

function odoo_integration_contact_form7($contact_form, &$abort, &$submission) {
  $options = get_field('odoo_integration', 'options');
  $form_ids = [
    'customer_support' => $options['сustomer_support_forms_ids'] ?? [],
    'sales_team' => $options['sales_team_forms_ids'] ?? []
  ];

  $customer_support_api_url = $options['customer_support_api_url'] ?? '';
  $sales_team_api_url = $options['sales_team_api_url'] ?? '';

  $form_type = '';
  if (in_array($contact_form->id(), $form_ids['customer_support'])) {
    $form_type = 'customer_support';
  } elseif (in_array($contact_form->id(), $form_ids['sales_team'])) {
    $form_type = 'sales_team';
  }

  if ($form_type) {
    if (($form_type == 'customer_support' && !$customer_support_api_url) || 
        ($form_type == 'sales_team' && !$sales_team_api_url)) {
      error_log('Error: API URL not set for form ' . $form_type);
      return;
    }

    $page_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No URL available';

    $posted_data = $submission->get_posted_data();
    $api_data = [
      'full_name' => $posted_data['userName'] ?? '',
      'email' => $posted_data['userEmail'] ?? '',
      'message' => $posted_data['userMessage'] ?? '',
      'company_name' => $posted_data['company'] ?? '',
      'page_url' => $page_url,
    ];

    if ($form_type == 'customer_support') {
      $api_data['client_type'] = $posted_data['client_type'] ?? '';
      $api_url = $customer_support_api_url;
    } else {
      $api_data['website'] = $posted_data['website'] ?? '';
      $api_data['industry'] = isset($posted_data['industry']) ? implode(',', $posted_data['industry']) : '';
      $api_data['country_of_incorporation'] = isset($posted_data['country']) ? implode(',', $posted_data['country']) : '';
      $api_data['projected_monthly_turnover_volume'] = $posted_data['turnover-volume'] ?? '';
      $api_url = $sales_team_api_url;
    }

    $response = wp_remote_post($api_url, [
      'headers' => [
        'Content-Type' => 'application/json',
      ],
      'body' => json_encode($api_data),
    ]);

    if (is_wp_error($response)) {
      error_log('Error: ' . $response->get_error_message());
    }
  }
}
