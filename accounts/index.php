<?php
//This is the accounts controller

//create or access a session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the accounts model
require_once '../model/accounts-model.php';
//validate the email and password
require_once '../library/functions.php';

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
    
  case 'register':
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    //checking for existing email address
    $uniqueEmail = uniqueEmail($clientEmail);

    if ($uniqueEmail) 
    {
      $message = '<p class="message">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    // check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword))
    {
      $message = "<p>Please provide information for all empty form fields.</p>";
      include '../view/registration.php';
      exit;
    }

    //hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    //send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // check and report the result
    if ($regOutcome === 1) 
    {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    }
    else
    {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }

    break;

  case 'Login':
    // Filter and store the data
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    if (empty($clientEmail) || empty($checkPassword))
      {
        $message = "<p class='message'>Please provide a valid email address and password.</p>";
        include '../view/login.php';
        exit;
      }

    //A valid password exists, proceed with the login process
    //Query the client data based on teh email address
    $clientData = getClient($clientEmail);
    //compare the password just submitted against
    //the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    //if the hashes don't match create an error 
    //and return to the login view
    if (!$hashCheck) 
    {
      $message = '<p class="message">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    //a valid user exitst, log them in
    $_SESSION['loggedin'] = TRUE;
    //remove the password from the array
    //the array_pop function removes the last
    //element from an array
    array_pop($clientData);
    //store the array into the session
    $_SESSION['clientData'] = $clientData;
    //sent them to the admin view
    include '../view/admin.php';
    exit;
  
    break;

  case 'Logout':
    session_unset();
    session_destroy();
    header('Location: ../');
    exit;
    break;

  case 'getClientById':
    $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
    $clientData = getClientById($clientId);
    if (count($clientData) < 1) {
      $message = '<p class="error">Sorry, no client information could be found.</p>';
    }

    include '../view/client-update.php';
    break;

  case 'uniqueEmail':
    //get clientEmail
    $clientEmail = filter_input(INPUT_GET, 'clientEmail');
    $clientEmail = urldecode($clientEmail);

    //checking for existing email address
    $uniqueEmail = uniqueEmail($clientEmail);
    echo json_encode($uniqueEmail);
    break;

  case 'updateClient':
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientEmail = checkEmail($clientEmail);

    // check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail))
    {
      $message = "<p class='error'>Please provide information for all form fields.</p>";
      include '../view/client-update.php';
      exit;
    }

    //send the data to the model
    $updateClientOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

    
    // check and report the result
    if ($updateClientOutcome === 1) 
    {
      $_SESSION['message'] = "<p class='success'>Thanks for updating your information, $clientFirstname.</p>";
      $clientData = getClientById($clientId);

      //remove the password from the array
      //the array_pop function removes the last
      //element from an array
      array_pop($clientData);
      //store the array into the session
      $_SESSION['clientData'] = $clientData;
      //sent them to the admin view
      header('Location: /phpmotors/accounts/');
      exit;
    }
    else
    {
      $_SESSION['message'] = "<p class='error'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
      header('Location: /phpmotors/accounts/');
      exit;
    }
    break;

  case 'updatePassword':
    // Filter and store the data
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $checkPassword = checkPassword($clientPassword);

    // check for missing data
    if (empty($checkPassword))
    {
      $message = "<p class='error'>Error: Password update failed. Please try again</p>";
      include '../view/client-update.php';
      exit;
    }

    //hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    //send the data to the model
    $updatePasswordOutcome = updatePassword($hashedPassword, $clientId);

    // check and report the result
    if ($updatePasswordOutcome === 1) 
    {
      $_SESSION['message'] = "<p class='success'>Thanks for updating your password, $clientFirstname.</p>";
      $clientData = getClientById($clientId);

      //remove the password from the array
      //the array_pop function removes the last
      //element from an array
      array_pop($clientData);
      //store the array into the session
      $_SESSION['clientData'] = $clientData;
      //sent them to the admin view
      header('Location: /phpmotors/accounts/');
      exit;
    }
    else
    {
      $_SESSION['message'] = "<p class='error'>Sorry $clientFirstname, but the password update failed. Please try again.</p>";
      header('Location: /phpmotors/accounts/');
      exit;
    }
    break;

  default:
    include '../view/admin.php';
    break;
}
?>