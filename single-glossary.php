<?php get_template_part( 'template-parts/pages/glossary/header' ); ?>

<section class="gl-content container" data-theme="dark">
  <h1 class="gl-content__title"><?php the_title(); ?></h1>
  <div class="gl-content__text"><?php the_content(); ?></div>
</section>

<?php get_footer(); ?>