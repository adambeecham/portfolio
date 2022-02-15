<?php
/**
 * Process Mail Functions
 * https://developer.wordpress.org/reference/functions/wp_mail/
 * https://github.com/andrimaruf/wp_mail/blob/master/functions.php
 */
add_action('wp_ajax_process_form', 'bgn_process_form');
add_action('wp_ajax_nopriv_process_form', 'bgn_process_form');

/**
 * Process
 */

function bgn_process_form() {

  if ( !check_ajax_referer( 'ajax-nonce', 'nonce', false ) ) {
    die('Permission denied');
  }

  if ( isset($_POST['sfu']) && $_POST['sfu'] == '' ) {

    $data = array();

    $form_id = isset($_POST['form_id']) ? $_POST['form_id'] : 0;

    $data['name']['label']            = 'Name';
    $data['name']['value']            = isset($_POST['name']) ? $_POST['name'] : '';
    $data['email_address']['label']   = 'Email Address';
    $data['email_address']['value']   = isset($_POST['email-address']) ? $_POST['email-address'] : '';
    $data['telephone']['label']       = 'Telephone';
    $data['telephone']['value']       = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    $data['address']['label']         = 'Address';
    $data['address']['value']         = isset($_POST['address']) ? $_POST['address'] : '';
    $data['message']['label']         = 'Message';
    $data['message']['value']         = isset($_POST['message']) ? $_POST['message'] : '';

    if ( $form_id == 1 ) {
      $subject = 'General Enquiry | BGN Website Enquiry';
      $footer = 'This e-mail was sent from the Contact Form on the BGN website';
    } else {
      $subject = 'General Enquiry | BGN Website Enquiry';
      $footer = 'This e-mail was sent from the Contact Form on the BGN website';
    }

    $sender_name      = 'No Reply';
    $sender_email     = 'noreply@bgn.agency';
    $recipient_name   = 'BGN Admin';
    $recipient_email  = 'admin@bgn.agency';
    $cc_name          = 'Adam';
    $cc_email         = 'adam@bgn.agency';
    $bcc_name         = 'Paul';
    $bcc_email        = 'paul@bgn.agency';

    $headers =  'Organization: BGN Agency' . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'X-Priority: 2' . "\r\n";
    $headers .= 'X-Mailer: PHP' . phpversion() . "\r\n";
    $headers .= 'To: ' . $recipient_name . ' <' . $recipient_email  . '>' . "\r\n";
    $headers .= 'Cc: ' . $cc_name . ' <' . $cc_email  . '>' . "\r\n";
    $headers .= 'Bcc: ' . $bcc_name . ' <' . $bcc_email  . '>' . "\r\n";
    $headers .= 'From: ' . $sender_name . ' <' . $sender_email . '>' . "\r\n";

    bgn_send_form_notification( $recipient_email, $subject, $headers, $data, $footer );

    die();
  }
}

/**
 * Send Form
 */

function bgn_send_form_notification( $recipient_email, $subject, $headers, $data, $footer ) {

  $fields = '';

  foreach ( $data as $key => $row ) {
    if ( !empty( $row['value'] ) ) {
      $fields .= sprintf('<p><strong>%s:</strong> %s', $row['label'], $row['value']);
    }
  }

  $search = array('*|SUBJECT|*', '*|FIELDS|*', '*|FOOTER|*');
  $replace = array($subject, $fields, $footer);

  $template = file_get_contents(get_template_directory() . '/template-emails/mail-notification.html');
  $template = str_replace( $search, $replace, $template );

  $result = wp_mail( $recipient_email, $subject, $template, $headers );
  return $result;
}