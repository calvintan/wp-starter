<?php get_header(); ?>

<main role="main">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <header class="page__header">
          <h1 class="page__title">
            <?php single_post_title(); ?>
          </h1>
        </header>
      </div>
    </div>
    <div class="row">
      <?php get_template_part('loop', 'index'); ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>