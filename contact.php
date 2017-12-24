<?php
/**
 * Created by PhpStorm.
 * User: devon
 * Date: 2017-12-14
 * Time: 3:47 PM
 */

$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$isOk = true;

if(empty($firstName)) {
    echo '<li class="error">Your First Name is Required</li>';
    $isOk = false;
}

if(empty($lastName)) {
    echo '<li class="error">Your Last Name is Required</li>';
    $isOk = false;
}

if(empty($email)) {
    echo '<li class="error">Your Email Address is Required</li>';
    $isOk = false;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<li class="error">Your Email Address is Required</li>';
    $isOk = false;
}

if(empty($message)) {
    echo '<li class="error">Please Send Me a Nice Message!</li>';
    $isOk = false;
}