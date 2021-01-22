<?php get_header(); ?>

<main role="main">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <header class="page__header">
          <h1 class="page__title">
            <?php printf(esc_html__('Search results for: %s', '_themename'), get_search_query()); ?>
          </h1>
        </header>
      </div>
    </div>
    <div class="row">
      <?php get_template_part('loop', 'search'); ?>
    </div>
    <?php the_posts_pagination(); ?>
  </div>
</main>

<?php get_footer(); ?>
