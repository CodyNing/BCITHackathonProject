<?php
session_start();

function __autoload($className){
    require_once("classes/$className.php");
} 

// redirect to home page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../php/error.php?code=1");
    exit();
}

// Open up a database using this file
$database = OfferTable::getInstance();
// increment the count attribute (total offers created including those deleted)
$info = array(
    "userid"    => $_SESSION['user_id'],
    "username"  => $_SESSION['user_name'],
    "date"      => $_POST['driver_date'],
    "time"      => $_POST['driver_time'],
    "start"     => $_POST['driver_start'],
    "end"       => $_POST['driver_end'],
    "seats"     => $_POST['driver_seats']
);
$database->addOffer($info);

// save the modification
$database->save();

// redirection
header("Location: ./../index.php");

?>