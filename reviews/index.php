<?php 
//this is the reviews controller
session_start();

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the vehicle model
require_once '../model/vehicles-model.php';
//validate the email and password
require_once '../library/functions.php';
require_once '../model/review-model.php';

$classifications = getClassifications();

$action = filter_input(INPUT_POST, 'action');
if ($action == null) 
{
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action)
{
  case 'addreview':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_STRING);
    insertReview($clientId, $invId, $review);
    include '../view/admin.php';
    break;

  case 'editview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $review = getReview($reviewId);
    $reviewText = $review['review'];
    $date = $review['reviewdate'];
    $date = date('d F, Y', strtotime($date));
    $invInfo = getVehicleByInvId($invId);
    include '../view/review-update.php';
    break;

  case 'updatereview':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_STRING);
    updateReview($review, $reviewId);
    $clientId = $_SESSION['clientData']['clientId'];
    $reviews = getReviewsByClientId($clientId);
    $rt = buildAdminReviewTable($reviews);

    include '../view/admin.php';
    break;

  case 'deleteconfirm':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $review = getReview($reviewId);
    $reviewText = $review['review'];
    $date = $review['reviewdate'];
    $date = date('d F, Y', strtotime($date));
    $invInfo = getVehicleByInvId($invId);
    $_SESSION['delete'] = 'delete';

    include '../view/review-delete.php';
    break;

  case 'deletereview':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    deleteReview($reviewId);
    $clientId = $_SESSION['clientData']['clientId'];
    $reviews = getReviewsByClientId($clientId);
    $rt = buildAdminReviewTable($reviews);

    include '../view/admin.php';
    break;

  default:
    $classificationList = buildClassificationList($classificationList);
      
    include '../view/vehicle-management.php';
    break;
}
?>