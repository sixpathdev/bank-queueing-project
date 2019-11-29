<?php
require_once "../controls.php";
require_once "../sys.php";

$customer;
$new_phone_number;
$new_seating_preference;

if(isset($_POST['customer_alter']) && $_POST['customer_alter'] != ""){
    $customer = $_POST['customer_alter'];
} 


if(isset($_POST['change_phone_number']) && $_POST['change_phone_number'] != ""){
    $new_phone_number = $_POST['change_phone_number'];
} 

if(isset($_POST['change_seating_preference']) && $_POST['change_seating_preference'] != ""){
    $new_seating_preference = $_POST['change_seating_preference'];    
} 

header('Location: ../admin_controls.php');

?>