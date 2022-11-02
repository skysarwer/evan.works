<?php
/**
* Builds the index for available appointment timeslots
* @package aber
*/

function evn_timeslots_ajax_url( ) {

    add_rewrite_tag('%timeslots%', '([^&]+)');
    add_rewrite_rule('json/timeslots/([^&]+)/?', 'index.php?timeslots=$matches[1]', 'top');
}

add_action('init', 'evn_timeslots_ajax_url');

function evn_timeslots_index() {
    global $wp_query;
    $timeslot = $wp_query->get('timeslots');

    if (!empty($timeslot)) {

        $local_time = current_time('timestamp');

        if ($timeslot == 'all') {

            $this_month_results = booked_appointments_available(date_i18n('Y',$local_time), (date_i18n('m',$local_time)), false, false, true);

            $next_month_results = booked_appointments_available(date_i18n('Y',$local_time), (date_i18n('m',$local_time) + 01), false, false, true);

            if(empty($this_month_results)) {
                $this_month_results = array();
            }

            if(empty($next_month_results)) {
                $next_month_results = array();
            }
    
            $result = array_merge( $this_month_results, $next_month_results);

        } else {

            $timestamp = strtotime($timeslot);
            $year_param = date('Y', $timestamp);
            $month_param = date('m', $timestamp);
            $day_param = date('d', $timestamp);

            $result = booked_appointments_available( $year_param,  $month_param, $day_param, false, true);

        }
        
        wp_send_json_success([
            $result,
         ]);
     
    }
}

add_action('template_redirect', 'evn_timeslots_index');

function evn_add_booking( $contact_form, $abort, $submission ) {
    // get the contact form object
    $wpcf = WPCF7_ContactForm::get_current();

    $posted_data = $submission->get_posted_data();

    if (empty($posted_data['show-booking'][0])) {
        return;
    }

    if ($posted_data['show-booking'][0] !== '') {

        //Build timestamp and post title

        $time_format = get_option('time_format');
        $date_format = get_option('date_format');

        $timestring_array = array(
            '1030-1100' => '10:30:00',
            '1100-1130' => '11:00:00',
            '1130-1200' => '11:30:00',
            '1200-1230' => '12:00:00',
            '1230-1300' => '12:30:00',
            '1300-1330' => '13:00:00',
            '1330-1400' => '13:30:00',
            '1400-1430' => '14:00:00',
            '1430-1500' => '14:30:00',
            '1500-1530' => '15:00:00',
            '1530-1600' => '15:30:00',
            '1600-1630' => '16:00:00',
            '1630-1700' => '16:30:00',
            '1700-1730' => '17:00:00',
        );

        $timestring = $timestring_array[$posted_data['book-hour'][0]];

        $timestamp = strtotime($posted_data['book-date'] . ' ' . $timestring);

        $title = date_i18n($date_format,$timestamp).' @ '.date_i18n($time_format,$timestamp).' (User: Guest)';

        //Build markup for Appointment information metafield
        ob_start(); ?>
            <p class="cf-meta-value">
                <strong>I am interested in discussing:</strong><br>
                <?php echo $posted_data['interested-in'][0];?>
            </p>
            <p class="cf-meta-value">
                <strong>Details</strong><br>
                <?php echo $posted_data['details'];?>
            </p>
            <!---
            <p class="cf-meta-value">
                <strong>File Attachment</strong><br>
                <?php //echo $posted_data['file-attachment'];?>
            </p>--->
        <?php
        $appointment_information_markup = ob_get_clean();

        //Create appointment

        $new_appointment = wp_insert_post (
            array(
                'post_type' => 'booked_appointments',
                'post_title' => $title, 
                'post_author' => 1,
                'post_content' => '',
                'post_status' => 'draft',
                'meta_input' => array(
                    '_appointmnet_title' => $title, 
                    '_appointment_guest_name' => esc_attr($posted_data['your-name']),
                    '_appointment_guest_email' => esc_attr($posted_data['email']),
                    '_appointment_timestamp' => $timestamp,
                    '_appointment_timeslot'=> $posted_data['book-hour'][0],
                    '_cf_meta_value' => $appointment_information_markup,
                )
            )
        );

        //Email management, skip CF7 email, send Booked email
        $contact_form->skip_mail = true;  
        
        $email_content = get_option('booked_appt_confirmation_email_content',false);
        $email_subject = get_option('booked_appt_confirmation_email_subject',false);

        $token_replacements = booked_get_appointment_tokens( $new_appointment );

        if ( $email_content && $email_subject ):

            $admin_email = booked_which_admin_to_send_email( false );
            $email_content = booked_token_replacement( $email_content,$token_replacements );
            $email_subject = booked_token_replacement( $email_subject,$token_replacements );
            do_action( 'booked_confirmation_email', $email, $email_subject, $email_content, $admin_email );

        endif;

        // Send an email to the Admin?
        $email_content = get_option('booked_admin_appointment_email_content',false);
        $email_subject = get_option('booked_admin_appointment_email_subject',false);
        if ($email_content && $email_subject):

            $admin_email = booked_which_admin_to_send_email( false );
            $email_content = booked_token_replacement( $email_content,$token_replacements );
            $email_subject = booked_token_replacement( $email_subject,$token_replacements );
            do_action( 'booked_admin_confirmation_email', $admin_email, $email_subject, $email_content, $token_replacements['email'], $token_replacements['name'] );

        endif;

        do_action('booked_new_appointment_created', $post_id);
  
    }

    return  $contact_form;
}

add_filter("wpcf7_before_send_mail", "evn_add_booking", 10, 3);  