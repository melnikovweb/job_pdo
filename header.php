<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SECRET
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- TODO: Check the meta's -->
  <meta name="msapplication-TileColor" content="#0040FF">
  <meta name="theme-color" content="#0040FF">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Syne:wght@400..800&display=swap" rel="stylesheet">

  <?php wp_head(); ?>

  <?php get_template_part('template-parts/header/head'); ?>
</head>

<body <?php body_class(); ?>>
  <?php get_template_part('template-parts/header/body-start'); ?>

  <div class="page-container">
    <?php wp_body_open(); ?>

    <div class="base-header" data-element="base-header">
      <?php get_template_part('template-parts/header/header-desktop'); ?>
      <?php get_template_part('template-parts/header/header-mobile'); ?>
    </div>

    <main class="content">