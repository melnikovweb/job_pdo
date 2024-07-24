<?php

namespace IconsSelectFilter;

function get_admin_icons_choices()
{
  return [
    'dot-separator_sm' => 'dot-separator_sm',
    'dot-separator' => 'dot-separator',
    'search' => 'search',
    'filter' => 'filter',
    'minus' => 'minus',
    'close' => 'close',
    'plus' => 'plus',
    'check' => 'check',
    'list' => 'list',
    'chevron-up' => 'chevron-up',
    'chevron-down' => 'chevron-down',
    'chevron-left' => 'chevron-left',
    'chevron-right' => 'chevron-right',
    'arrow-left-up' => 'arrow-left-up',
    'arrow-left-down' => 'arrow-left-down',
    'arrow-right-up' => 'arrow-right-up',
    'arrow-right-down' => 'arrow-right-down',
    'arrow-right' => 'arrow-right',
    'arrow-up' => 'arrow-up',
    'arrow-down' => 'arrow-down',
    'arrow-left' => 'arrow-left',
    'up-big' => 'up-big',
    'down-big' => 'down-big',
    'map-2' => 'map-2',
    'advertising' => 'advertising',
    'affiliate' => 'affiliate',
    'api-2' => 'api-2',
    'api' => 'api',
    'bank-3' => 'bank-3',
    'book' => 'book',
    'brain-2' => 'brain-2',
    'brain-3' => 'brain-3',
    'brain' => 'brain',
    'card-1' => 'card-1',
    'card-2' => 'card-2',
    'chart' => 'chart',
    'check-circle' => 'check-circle',
    'clock-backward' => 'clock-backward',
    'clock-check' => 'clock-check',
    'computer-pay' => 'computer-pay',
    'computer-cursor' => 'computer-cursor',
    'computer' => 'computer',
    'crypto' => 'crypto',
    'desktop-code' => 'desktop-code',
    'exchange' => 'exchange',
    'games-1' => 'games-1',
    'games-2' => 'games-2',
    'gear' => 'gear',
    'globe-2' => 'globe-2',
    'globe-4' => 'globe-4',
    'globe' => 'globe',
    'hand' => 'hand',
    'import-and-export' => 'import-and-export',
    'legal' => 'legal',
    'line-down' => 'line-down',
    'line-up' => 'line-up',
    'number-1' => 'number-1',
    'partner' => 'partner',
    'pie-chart' => 'pie-chart',
    'play-card' => 'play-card',
    'sales' => 'sales',
    'shield-card' => 'shield-card',
    'shield-check' => 'shield-check',
    'speaker' => 'speaker',
    'support' => 'support',
    'users-profiles-1' => 'users-profiles-1',
    'users-profiles-2' => 'users-profiles-2',
    'users-profiles-3' => 'users-profiles-3',
    'wrenchnum' => 'wrenchnum',
    'bitcoin' => 'bitcoin',
    'esports' => 'esports',
    'games-of-chance' => 'games-of-chance',
    'gift-activation-cards' => 'gift-activation-cards',
    'logistics' => 'logistics',
    'manufacturing' => 'manufacturing',
    'pain-poins' => 'pain-poins',
    'payment-gateways-1' => 'payment-gateways-1',
    'payment-gateways' => 'payment-gateways',
    'payment-services-Providers' => 'payment-services-Providers',
    'skill-games' => 'skill-games',
    'construction' => 'construction',
    'solution' => 'solution',
  ];
}

function set_admin_icons_choices($field)
{
  $field['type'] = 'select';
  $field["allow_null"] = 1;
  $field["multiple"] =  0;
  $field["ui"] = 1;
  $field['choices'] = get_admin_icons_choices();

  return $field;
}

add_filter('acf/load_field/name=icons_select', 'IconsSelectFilter\set_admin_icons_choices');
