<?php
Enqueue::style('public/parts/contact-form-component/contact-form-component.css', [
  'is_root_path' => true
]);

$contact_form = Enqueue::script('public/parts/contact-form-component/contact-form-component.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::CHOICES
], [
  'is_root_path' => true,
]);

$contact_form->localize('wpPageData', array(
  'countryFilterPlaceholder' => 'Country of incorporation',
  'allCountries' => CountryDataApi\get_all_available_countries(),
));

$form_shortcode = $args['form_shortcode'] ?? '';
?>

<div class="contact-form">
  <?php echo do_shortcode(get_sub_field('form_shortcode')); ?>
</div>
