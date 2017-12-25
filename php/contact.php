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
$form_errors = array();

if(empty($first_name)) {
    echo '<li class="error">Your First Name is Required</li>';
    $is_ok = false;
    $form_errors['first-name'] = true;
}

if(empty($last_name)) {
    echo '<li class="error">Your Last Name is Required</li>';
    $is_ok = false;
    $form_errors['last-name'] = true;
}

if(empty($email)) {
    echo '<li class="error">Your Email Address is Required</li>';
    $is_ok = false;
    $form_errors['email'] = true;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<li class="error">A Valid Email Address is Required</li>';
    $is_ok = false;
    $form_errors['email'] = true;
}

if(empty($message)) {
    echo '<li class="error">Please Send Me a Nice Message!</li>';
    $is_ok = false;
    $form_errors['message'] = true;
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

//    mail($mail_to, $mail_subject, $mail_message, $headers);

    if($is_ajax) {
        echo '<li class="success">Thanks for your Ajax message. I will get back to you as soon as I can.</li>';
        return $form_errors;
    } else {
        $_SESSION['confirm-msg'] = '<li class="success">Thanks for your PHP message. I will get back to you as soon as I can.</li>';
        header('location:../index.php');
        exit();
    }
} elseif (!$is_ok && !$is_ajax) {
    $_SESSION['errors'] =  $form_errors;
    $_SESSION['confirm-msg'] = '<li class="success">There are some issues with your submission. See below.</li>';
    header('location:../index.php');
    exit();
}