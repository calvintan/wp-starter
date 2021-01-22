<?php
  /* Custom columns for Member post type */
  function add_member_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
      'photo' => __ ( 'Photo' ),
      'member_type' => __ ( 'Type' ),
      'member_position'   => __ ( 'Position' ) 
    ) );
  }
  add_filter ( 'manage_member_posts_columns', 'add_member_acf_columns' );

  function member_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'photo' :
        echo get_the_post_thumbnail( $post_id, 'profile-size' );
        break;
      case 'member_type':
        echo get_post_meta ( $post_id, 'member_type', true );
        break;
      case 'member_position':
        echo get_post_meta ( $post_id, 'member_position', true );
        break;
    }
  }
  add_action ( 'manage_member_posts_custom_column', 'member_custom_column', 10, 2 );

  function set_custom_member_sortable_columns( $columns ) {
    $columns['member_type'] = 'member_type';

    return $columns;
  }

  add_filter( 'manage_edit-member_sortable_columns', 'set_custom_member_sortable_columns' );

  /* Custom columns for Event post type */
  function add_event_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
      'photo' => __ ( 'Photo' ),
      'event_date' => __ ( 'Event Date' ),
      'event_start_time' => __ ( 'Start Time' ),
      'event_end_time'   => __ ( 'End Time' ) 
    ) );
  }
  add_filter ( 'manage_event_posts_columns', 'add_event_acf_columns' );

  function event_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'photo' :
        echo get_the_post_thumbnail( $post_id, 'feature-size' );
        break;
      case 'event_date':
        $date = get_post_meta ( $post_id, 'event_date', true );
        
        if ( $date ) {
          echo date('j F Y', strtotime($date));
        } else {
          esc_html_e( 'N/A', '_themename' );
        }
        break;
      case 'event_start_time':
        echo get_post_meta ( $post_id, 'event_start_time', true );
        break;
      case 'event_end_time':
        echo get_post_meta ( $post_id, 'event_end_time', true );
        break;
    }
  }
  add_action ( 'manage_event_posts_custom_column', 'event_custom_column', 10, 2 );

  /* Add event date to Quick Edit */
  function quick_edit_add( $column_name, $post_type ) {
    if ( 'event_date' != $column_name ) {
      return;
    }

    $date = get_post_meta ( $post_id, 'event_date', true );
    
    printf('
      <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label>
                <span class="title">Event Date</span>
                <span class="input-text-wrap">
                  <input type="text" name="event_date" class="gieventdate value="" placeholder="YYYYMMDD">
                </span>
            </label>
        </div>
      </fieldset>'
    );
  }
  add_action( 'quick_edit_custom_box', 'quick_edit_add', 10, 2 );

  function save_quick_edit_post( $post_id, $post ) {
    // if called by autosave, then bail here
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    // if this "event" post type?
    if ( $post->post_type != 'event' )
        return;

    // does this user have permissions?
     if ( ! current_user_can( 'edit_post', $post_id ) )
         return;

    // update!
    if ( isset( $_POST['event_date'] ) ) {
        update_post_meta( $post_id, 'event_date', $_POST['event_date'] );
    }
  }
  add_action( 'save_post', 'save_quick_edit_post', 10, 2 );

  function quick_edit_javascript() {
    $current_screen = get_current_screen();
    if ( $current_screen->post_type != 'event' )
        return;
    ?>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        jQuery('#the-list').on( 'click', 'button.editinline', function(e) {
          e.preventDefault();
          var eventDate = jQuery(this).data('event_date');
          inlineEditPost.revert();
          jQuery('.gieventdate').val(eventDate ? eventDate : '');
        });
      })
    </script>
    <?php
  }
  add_action( 'admin_enqueue_scripts', 'quick_edit_javascript' );

  function quick_edit_set_data( $actions, $post ) {
    $found_value = get_post_meta( $post->ID, 'event_date', true );

    if ( $found_value ) {
        if ( isset( $actions['inline hide-if-no-js'] ) ) {
            $new_attribute = sprintf( 'data-event_date="%s"', esc_attr( $found_value ) );
            $actions['inline hide-if-no-js'] = str_replace( 'class=', "$new_attribute class=", $actions['inline hide-if-no-js'] );
        }
    }

    return $actions;
  }
  add_filter('post_row_actions', 'quick_edit_set_data', 10, 2);

  /* Custom columns for Initiative post type */
  function add_initiative_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
      'photo' => __ ( 'Photo' ),
      'project_start_date' => __ ( 'Start Date' ),
      'project_end_date'   => __ ( 'End Date' ) 
    ) );
  }
  add_filter ( 'manage_initiative_posts_columns', 'add_initiative_acf_columns' );

  function initiative_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'photo' :
        echo get_the_post_thumbnail( $post_id, 'feature-size' );
        break;
      case 'project_start_date':
        $start_date = get_post_meta ( $post_id, 'project_start_date', true );
        echo date('j F Y', strtotime($start_date));
        break;
      case 'project_end_date':
        $end_date = get_post_meta ( $post_id, 'project_end_date', true );
        echo date('j F Y', strtotime($end_date));
        break;
    }
  }
  add_action ( 'manage_initiative_posts_custom_column', 'initiative_custom_column', 10, 2 );

  /* Custom columns for Partner post type */
  function add_partner_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
      'partner_logo' => __ ( 'Logo' )
    ) );
  }
  add_filter ( 'manage_partner_posts_columns', 'add_partner_acf_columns' );

  function partner_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'partner_logo' :
        $image_id = get_post_meta ( $post_id, 'partner_logo', true );
        $image = wp_get_attachment_image_src($image_id, 'logo-size');
        echo '<img width="'.$image[1].'" height="'.$image[2].'" src='.$image[0].'>';
        break;
    }
  }
  add_action ( 'manage_partner_posts_custom_column', 'partner_custom_column', 10, 2 );
?>