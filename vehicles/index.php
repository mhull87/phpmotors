<?php
//This is the vehicles controller

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the vehicle model
require_once '../model/vehicles-model.php';

//Get the array of classifications
$classifications = getClassifications();

  $classificationList .= "<label for='classificationList'>Choose a Vehicle:</label><br><select name='classificationList' id='classificationList'>";

//Create a dynamic drop-down select list
foreach ($classifications as $classification) 
{
$classificationList .= "<option value='".urlencode($classification['classificationId'])."'>".urlencode($classification['classificationName'])."</option>";
}

$classificationList .= "</select>";

//echo $classificationList;

$action = filter_input(INPUT_POST, 'action');
if ($action == null) 
{
$action = filter_input(INPUT_GET, 'action');
}

switch ($action)
{
  case 'login':
    include '../view/login.php';
    break;
  case 'addclassification':
    //Filter and store the data
    $classificationName = filter_input(INPUT_POST, 'classificationName');

    //Check for missing data
    if (empty($classificationName))
    {
      $message = "<p>Please provide a classification name</p>";
      include '../view/add-classification.php';
      exit;
    } else
    {
      header('/phpmotors/view/vehicle-management.php');
      exit;
    }
    break;
  case 'addvehicle':

    include '../view/add-vehicle.php';
    break;
  default:
      include '../view/vehicle-management.php';
}

?>