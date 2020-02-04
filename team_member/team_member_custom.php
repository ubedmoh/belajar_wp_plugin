<?php

    add_action( 'admin_init', 'team_member_admin' );

    function team_member_admin() {
        add_meta_box( 'team_member_meta_box',
            'member Details',
            'display_team_member_meta_box',
            'team_members', 'normal', 'high'
        );
    }

    function display_team_member_meta_box( $team_member ) {
        
        $member_position = esc_html( get_post_meta( $team_member->ID, 'member_position', true ) );
        $member_email = esc_html( get_post_meta( $team_member->ID, 'member_email', true ) );
        $member_phone = esc_html( get_post_meta( $team_member->ID, 'member_phone', true ) );
        $member_website = esc_html( get_post_meta( $team_member->ID, 'member_website', true ) );
        $member_image = esc_html( get_post_meta( $team_member->ID, 'member_image', true ) );

        ?>
        <table>
            <tr>
                <td style="width: 100%">Position</td>
                <td><input type="text" size="40" name="team_member_position" value="<?php echo $member_position; ?>" /></td>
            </tr>
            <tr>
                <td style="width: 100%">Email</td>
                <td><input type="email" size="40" name="team_member_email" value="<?php echo $member_email; ?>" /></td>
            </tr>
            <tr>
                <td style="width: 100%">Phone</td>
                <td><input type="text" size="40" name="team_member_phone" value="<?php echo $member_phone; ?>" /></td>
            </tr>
            <tr>
                <td style="width: 100%">Website</td>
                <td><input type="text" size="40" name="team_member_website" value="<?php echo $member_website; ?>" /></td>
            </tr>
            <!-- <tr>
                <td style="width: 100%">Image</td>
                <td><input type="file" size="40" name="team_member_image" /></td>
            </tr> -->
        </table>
        <?php
    }

    add_action( 'save_post', 'add_team_member_fields', 10, 2 );

    function add_team_member_fields( $team_member_id, $team_member ) {
        // Check post type for member team
        if ( $team_member->post_type == 'team_members' ) {
            // Store data in post meta table if present in post data
            if ( isset( $_POST['team_member_position'] ) && $_POST['team_member_position'] != '' ) {
                update_post_meta( $team_member_id, 'member_position', $_POST['team_member_position'] );
            }
            if ( isset( $_POST['team_member_email'] ) && $_POST['team_member_email'] != '' ) {
                update_post_meta( $team_member_id, 'member_email', $_POST['team_member_email'] );
            }
            if ( isset( $_POST['team_member_phone'] ) && $_POST['team_member_phone'] != '' ) {
                update_post_meta( $team_member_id, 'member_phone', $_POST['team_member_phone'] );
            }
            if ( isset( $_POST['team_member_website'] ) && $_POST['team_member_website'] != '' ) {
                update_post_meta( $team_member_id, 'member_website', $_POST['team_member_website'] );
            }
            // if (! empty($_FILES['team_member_image']['name'])) {

            //     $upload = wp_upload_bits($_FILES['team_member_image']['name'],null, file_get_contents($_FILES['team_member_image']['tmp_name']));

            //     update_post_meta( $team_member_id, 'member_image',$upload );
            // }
        }
    }

    function team_member_list()
    {
        $args = array('post_type' => 'team_members');
        $the_query = new WP_Query($args);

        while ( $the_query->have_posts() ) : $the_query->next_post();
        $id= $the_query->post->ID;
        $position = get_post_meta($id, 'member_position', true);
        echo $position;
        endwhile;
    }

    function team_member_shortcode()
    {
        ob_start();
        team_member_list();

        return ob_clean();
    }
    
    add_shortcode('team_member_short', 'team_member_shortcode');

?>