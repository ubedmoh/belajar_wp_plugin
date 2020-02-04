<?php

    function testimoni_form_show()
    {
        echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
        echo '<p>';
        echo 'Your Name (required) <br />';
        echo '<input type="text" name="testi-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["testi-name"] ) ? esc_attr( $_POST["testi-name"] ) : '' ) . '" size="40" required/>';
        echo '</p>';
        echo '<p>';
        echo 'Your Email (required) <br />';
        echo '<input type="email" name="testi-email" value="' . ( isset( $_POST["testi-email"] ) ? esc_attr( $_POST["testi-email"] ) : '' ) . '" size="40" required/>';
        echo '</p>';
        echo '<p>';
        echo 'Your Phone Number (required) <br />';
        echo '<input type="text" name="testi-phone_number" value="' . ( isset( $_POST["testi-phone_number"] ) ? esc_attr( $_POST["testi-phone_number"] ) : '' ) . '" size="40" required />';
        echo '</p>';
        echo '<p>';
        echo 'Your Testimonial <br />';
        echo '<textarea rows="10" cols="35" name="testi-testimonial">' . ( isset( $_POST["testi-testimonial"] ) ? esc_attr( $_POST["testi-testimonial"] ) : '' ) . '</textarea>';
        echo '</p>';
        echo '<p><input type="submit" name="testi-submitted" value="Send"/></p>';
        echo '</form>';
    }

    function testimoni_save_data()
    {
        if ( isset( $_POST['testi-submitted'] ) ) {

            // sanitize form values
            $name    = sanitize_text_field( $_POST["testi-name"] );
            $email   = sanitize_email( $_POST["testi-email"] );
            $phone_number = sanitize_text_field( $_POST["testi-phone_number"] );
            $testimonial = esc_textarea( $_POST["testi-testimonial"] );

            $error = array();
            if (strlen($name) > 25) {
                
                $error[] = '<p style="color:red;">Name : max 25 character</p>';
            }

            if (!preg_match('/^[1-9][0-9]*$/', $phone_number)) {
                $error[] = '<p style="color:red;">Phone Number : contain a number</p>';
            }

            if (empty($testimonial)) {
                $error[] = '<p style="color:red;">Testimoni : can\'t be empty</p>';
            }

            if (count($error) > 1) {
                foreach ($error as $value) {
                    echo $value;
                }
            }else{
                
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
    }

    function testimoni_shortcode()
    {
        ob_start();
        testimoni_save_data();
        testimoni_form_show();

        return ob_get_clean();
    }

    add_shortcode( 'sitepoint_testimoni_form', 'testimoni_shortcode' );

?>