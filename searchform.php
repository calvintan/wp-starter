<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
  <label>
    <input type="search" class="search-field" value="<?php echo esc_attr(get_search_query()) ?>" name="s" aria-label="Search" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', '_themename' ) ?>" />
  </label>
  <button type="submit" class="search-submit">
    Search
  </button>
</form>