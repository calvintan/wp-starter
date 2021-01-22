<article <?php post_class('c-post mb-4'); ?>>
  <?php if(is_single()) { ?>
  <div class="row">
    <div class="col-md-12">
      <header class="c-post__header">
        <h1 class="c-post__single-title">
          <?php the_title();?>
        </h1>
        <p><?php _themename_post_meta(); ?></p>
      </header>
    </div>
  </div>
  <?php } ?>
  
  <?php if(get_the_post_thumbnail() !== '') { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="c-post__thumbnail">
        <?php the_post_thumbnail('large'); ?>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php if(is_single()) { ?>
    <div class="row">
      <div class="col-md-12">
        <div class="c-post__inner">
          <div class="c-post__content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>

    <?php if( has_tag() ): ?>
    <div class="row">
      <div class="col-md-8 offset-md-4">
        <footer class="c-post__footer">
          <div class="c-post__tags">
            <h4>
              <?php esc_html_e( 'Tags', '_themename' ); ?>
            </h4>
            <?php
              $tags_list = get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
              echo $tags_list;
            ?>
          </div>
        </footer>
      </div>
    </div>
    <?php endif; ?>
  <?php } ?>

  <?php if(!is_single()) { ?>
    <div class="row">
      <div class="col-md-8">
        <div class="c-post__inner">
          <h3 class="c-post__title">
            <a 
              href="<?php the_permalink(); ?>" 
              title="<?php the_title_attribute(); ?>">
              <?php the_title();?></a>
          </h3>
        </div>
        <?php if(!is_single()) {_themename_readmore_link();} ?>
      </div>
    </div>
  <?php } ?>
</article>