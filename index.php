<?php
//This is the main controller

//create or access a session
session_start();

//Get the database connection file
require_once 'library/connections.php';
//Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
}

//check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname']))
{
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
  case 'template':
    include 'view/template.php';
    break;
  default:
    include 'view/home.php';
    break;
}
?>