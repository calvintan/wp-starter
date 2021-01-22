<?php if(!is_front_page()) { ?>
  <header class="page__header">
    <h1 class="page__title">
      <?php the_title(); ?>
    </h1>
  </header>
<?php } ?>

<div class="page__content">
  <?php the_content(); ?>
</div>
