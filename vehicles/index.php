<?php
//This is the vehicles controller
//create or access a session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the vehicle model
require_once '../model/vehicles-model.php';
//validate the email and password
require_once '../library/functions.php';

$classifications = getClassifications();

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
    $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

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
      exit;
    }

    break;

  case 'addvehicle':
    //Filter and store data
    $classificationId = filter_input(INPUT_POST, 'classificationList', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
    $checkPrice = checkPrice($invPrice);

    //check for missing data
    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkPrice) || empty($invStock) || empty($invColor))
    {
      $message = "<p>Please provide information for all empty form fields.</p>";

      include '../view/add-vehicle.php';
      exit;
    } 
    else
    {
    $addOutcome = addVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);

        //check and report the result
        if ($addOutcome === 1)
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