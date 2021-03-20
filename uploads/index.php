<?php //image upload controller
session_start();
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

/* * ****************************************************
* Variables for use with the Image Upload Functionality
* **************************************************** */
//directory name where uploaded inages are stored
$image_dir = '/phpmotors/images/vehicles';
//the path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'].$image_dir;

switch ($action) {
  case 'upload':
      //store the incoming vehicle id and primary picture indicator
      $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
      $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);

      //store the name of the uploaded image
      $imgName = $_FILES['file1']['name'];

      $imgCheck = checkExistingImage($imgName);

      if ($imgCheck) {
        $message = '<p class="error">An image by that name already exists.</p>';
      } elseif (empty($invId) || empty($imgName)) {
        $message = '<p class="error">You must select a vehicle and image file for the vehicle.</p>';
      } else {
        //upload the image, store the returned path to the file
        $imgPath = uploadFile('file1');

        //insert the image information to the database, get the result
        $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);

        //set a message based on the insert result
        if ($result) {
          $message = '<p class="success">The upload succeeded.</p>';
        } else {
          $message = '<p class="error">Sorry, the upload failed.</p>';
        }
      }

      //store message to session
      $_SESSION['message'] = $message;

      //redirect to this controller for default action
      header('Location: .');
    break;
  case 'delete':
      // Get the image name and id
    $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
    $imgId = filter_input(INPUT_GET, 'imgid', FILTER_VALIDATE_INT);
          
    // Build the full path to the image to be deleted
    $target = $image_dir_path . '/' . $filename;
          
    // Check that the file exists in that location
    if (file_exists($target)) {
    // Deletes the file in the folder
    $result = unlink($target); 
    }
          
    // Remove from database only if physical file deleted
    if ($result) {
    $remove = deleteImage($imgId);
    }
          
    // Set a message based on the delete result
    if ($remove) {
    $message = "<p class='success'>$filename was successfully deleted.</p>";
    } else {
    $message = "<p class='error'>$filename was NOT deleted.</p>";
    }
          
    // Store message to session
    $_SESSION['message'] = $message;
          
    // Redirect to this controller for default action
    header('location: .');
    break;
  default:
      //call function to return image info from database
      $imageArray = getImages();

      //build the image information into HTML for display
      if (count($imageArray)) {
        $imageDisplay = buildImageDisplay($imageArray);
      } else {
        $imageDisplay = '<p class="error">Sorry, no image could be found.</p>';
      }

      //get vehicles information from database
      $vehicles = getVehicles();
      //build a select list of vehicle information for the view
      $prodSelect = buildVehiclesSelect($vehicles);
      $_SESSION['imageadmin'] = 'imageadmin';
      include '../view/image-admin.php';
      exit;
    break;
}
?>