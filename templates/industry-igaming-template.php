<?php
// Template Name: Industry Igaming template

set_header_theme(array(
  'background' => 'dark',
  'invert' => true
));

get_header();

?>

<?php get_template_part('template-parts/sections/banner-lottie'); ?>

<?php get_template_part('template-parts/sections/obstacles-section'); ?>

<?php get_template_part('template-parts/sections/animated-cards-section', '', [
  'group_name' => 'iban_solutions_section',
  'class_name' => 'cards-iban-solutions'
]); ?>

<?php get_template_part('template-parts/sections/animated-cards-section', '', [
  'group_name' => 'accept_payments_section',
  'class_name' => 'cards-accept-payments'
]); ?>

<?php get_template_part('template-parts/sections/animated-cards-section', '', [
  'group_name' => 'our_solution_section',
  'class_name' => 'cards-our-solution'
]); ?>

<?php get_template_part('template-parts/sections/leaders-section'); ?>

<?php get_template_part('template-parts/sections/animated-cards-section', '', [
  'group_name' => 'why_choose_section',
  'class_name' => 'cards-why-choose'
]); ?>

<?php get_template_part('template-parts/sections/get-started-with-icons-section'); ?>

<?php get_template_part('template-parts/sections/faq-section'); ?>

<?php get_footer(); ?>
