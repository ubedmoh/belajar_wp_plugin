<?php

function html_form_code()
    {
        echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
        echo '<p>';
        echo 'Your Name (required) <br />';
        echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo 'Your Email (required) <br />';
        echo '<input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo 'Your Phone Number (required) <br />';
        echo '<input type="text" name="cf-phone_number" value="' . ( isset( $_POST["cf-phone_number"] ) ? esc_attr( $_POST["cf-phone_number"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo 'Your Testimonial <br />';
        echo '<textarea rows="10" cols="35" name="cf-testimonial">' . ( isset( $_POST["cf-testimonial"] ) ? esc_attr( $_POST["cf-testimonial"] ) : '' ) . '</textarea>';
        echo '</p>';
        echo '<p><input type="submit" name="cf-submitted" value="Send"/></p>';
        echo '</form>';
    }

    function save_data()
    {
        if ( isset( $_POST['cf-submitted'] ) ) {

            // sanitize form values
            $name    = sanitize_text_field( $_POST["cf-name"] );
            $email   = sanitize_email( $_POST["cf-email"] );
            $phone_number = sanitize_text_field( $_POST["cf-phone_number"] );
            $testimonial = esc_textarea( $_POST["cf-testimonial"] );
    
            $data = array(
                'name'          => $name,
                'email'         => $email,
                'phone_number'  => $phone_number,
                'testimonial'   => $testimonial,
            );

            global $wpdb;
            $saving = $wpdb->insert('testimonial', $data, ['%s', '%s', '%d', '%s']);
    
            if($saving)
            {
                echo '<p>Berhasil menyimpan data!</p>';
            }else{
                echo '<p>Gagal menyimpan data!</p>';
            }
        }
    }

    function cf_shortcode()
    {
        ob_start();
        save_data();
        html_form_code();

        return ob_get_clean();
    }

    add_shortcode( 'sitepoint_contact_form', 'cf_shortcode' );

?>