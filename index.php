<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-md-<?php echo is_active_sidebar('primary-sidebar') ? '8' : '12'; ?>">
      <main role="main">
        <?php get_template_part('loop', 'index'); ?>
      </main>
    </div>
    <?php if(is_active_sidebar('primary-sidebar')) { ?>
      <div class="col-md-4">
        <?php get_sidebar(); ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php get_footer(); ?>