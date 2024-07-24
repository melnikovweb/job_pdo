<?php
Enqueue::script('public/parts/splash-screen/splash-screen.js', [], [
  'is_root_path' => true,
]);
?>

<div id="splash-screen-animation-container" class="splash-screen">
  <div class="splash-screen__logo">
    <div class="splash-screen__logo-wrapper">
      <img src="<?php echo get_template_directory_uri() . '/assets/images/general/logo.svg' ?>" width="300" height="94" alt="SECRET">
    </div>

    <div class="splash-screen__logo-wrapper" aria-hidden="true">
      <img src="<?php echo get_template_directory_uri() . '/assets/images/general/logo.svg' ?>" width="300" height="94" aria-hidden="true" alt="SECRET">
    </div>
  </div>
</div>