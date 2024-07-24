<?php

namespace FunctionPars\EnqueueScripts;

class GlobalScripts
{
  const SWIPER = 'swiper';
  const CHOICES = 'choices';
  const DATATABLES = 'datatables';
  const ISOTOPE = 'isotope';
  const LOTTIE = 'lottie';
}

add_action('wp_enqueue_scripts', 'FunctionPars\EnqueueScripts\enqueue_global_scripts');
function enqueue_global_scripts()
{
  \Enqueue::register(GlobalScripts::SWIPER, '/assets/libs/swiper/swiper.js');
  \Enqueue::register(GlobalScripts::CHOICES, '/assets/libs/choices/choices.min.js');
  \Enqueue::register(GlobalScripts::DATATABLES, '/assets/libs/data-table/datatables.min.js', ['jquery']);
  \Enqueue::register(GlobalScripts::ISOTOPE, '/assets/libs/isotope/isotope.min.js');
  \Enqueue::register(GlobalScripts::LOTTIE, '/assets/libs/lottie/lottie.min.js');
}
