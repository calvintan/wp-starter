<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <main role="main">
        <h3>
          <?php esc_html_e('Nothing found here, maybe you can try to search?', '_themename'); ?>
        </h3>
        <?php get_search_form(); ?>
      </main>
    </div>
  </div>
</div>

<?php get_footer(); ?>