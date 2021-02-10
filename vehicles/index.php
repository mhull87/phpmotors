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

  $classificationList = "<label for='classificationList'>Choose a Vehicle:</label><br><select name='classificationList' id='classificationList'>";

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
      $message = "<p>Please provide a classification name.</p>";
      include '../view/add-classification.php';
      exit;
    } 
    else
    {
      $addOutcome = newClassification($classificationName);
      header('Location:../vehicles/index.php');
    //  include '../view/vehicle-management.php';
      exit;
    }

    break;

  case 'addvehicle':
    //Filter and store data
    $classificationId = filter_input(INPUT_POST, 'classificationList');
    $invMake = filter_input(INPUT_POST, 'invMake');
    $invModel = filter_input(INPUT_POST, 'invModel');
    $invDescription = filter_input(INPUT_POST, 'invDescription');
    $invImage = filter_input(INPUT_POST, 'invImage');
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
    $invPrice = filter_input(INPUT_POST, 'invPrice');
    $invStock = filter_input(INPUT_POST, 'invStock');
    $invColor = filter_input(INPUT_POST, 'invColor');

    //check for missing data
    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor))
    {
      $message = "<p>Please provide information for all empty form fields.</p>";

      include '../view/add-vehicle.php';
      exit;
    } 
    else
    {
    $addOutcome = addVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);

        //check and report the result
        if ($addOutcome == 1)
        {
          $message = "<h2>$invMake $invModel Added to Inventory List</h2>";
          include '../view/vehicle-management.php';
          exit;
        }
        else
        {
          $message = "<p>Sorry, the addition failed. Please try again.</p>";
          include '../view/add-vehicle.php';
          exit;
        }
    }

    break;

  default:
      include '../view/vehicle-management.php';
}

?>