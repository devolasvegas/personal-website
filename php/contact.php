<?php session_start();
/**
 * Created by PhpStorm.
 * User: devon
 * Date: 2017-12-14
 * Time: 3:47 PM
 */

$first_name = $_POST['first-name'];
$last_name = $_POST['last-name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$is_ajax = $_POST['is-ajax'];
$is_ok = true;
$form_msgs = array();

if(empty($first_name)) {
    $is_ok = false;
    $form_msgs['first-name'] = true;
}

if(empty($last_name)) {
    $is_ok = false;
    $form_msgs['last-name'] = true;
}

if(empty($email)) {
    $is_ok = false;
    $form_msgs['email'] = true;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $is_ok = false;
    $form_msgs['email'] = true;
}

if(empty($message)) {
    $is_ok = false;
    $form_msgs['message'] = true;
}

if($is_ok) {

    require_once ('mailing-details.php');

    $mail_to = $my_address;
    $mail_from = $from_address;
    $mail_subject = 'New Submission from ' . $domain . 'Contact Form';

    $mail_message = "Your new submission details: \n";
    $mail_message .= "First Name: " . htmlspecialchars($first_name) . "\n";
    $mail_message .= "Last Name: " . htmlspecialchars($last_name) . "\n";
    $mail_message .= "Email Address: " . filter_var($email, FILTER_SANITIZE_EMAIL) . "\n";
    $mail_message .= "Phone Number: " . htmlspecialchars($phone) . "\n";
    $mail_message .= "Message: " . htmlspecialchars($message) . "\n";

    $headers = "From: " . $mail_from . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    mail($mail_to, $mail_subject, $mail_message, $headers);

    if($is_ajax) {
        $form_msgs['formMessage'] = '<li class="success">Thanks for your Ajax message. I will get back to you as soon as I can.</li>';
        print json_encode($form_msgs);
    } else {
        $_SESSION['confirm-msg'] = '<li class="success">Thanks for your PHP message. I will get back to you as soon as I can.</li>';
        header('location:../index.php');
        exit();
    }
} elseif (!$is_ok && !$is_ajax) {
    $_SESSION['errors'] =  $form_msgs;
    $_SESSION['confirm-msg'] = '<li class="error-msg">There are some issues with your submission. See below.</li>';
    header('location:../index.php');
    exit();
} elseif (!$is_ok && $is_ajax) {
    $form_msgs['formMessage'] = '<li class="error-msg">There are some issues with your submission. See below.</li>';
    print json_encode($form_msgs);
}