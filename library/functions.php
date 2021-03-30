<?php    
//Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';

//custom functions
$classifications = getClassifications();
//validate client email
function checkEmail($clientEmail)
  {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
  }

//Check the password for a minimum of 8 characters,
//at least 1 capital letter, at least 1 number and
//at least 1 special character
function checkPassword($clientPassword)
  {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
  }

//check price for only digits and 2 numbers after the decimal
function checkPrice($invPrice)
  {
    $pattern= '/^\d+(?:\.\d{2})$/';
    return preg_match($pattern, $invPrice);
  }

//create nav list
function nav($classifications)
  {
    //Build a navigation bar using the $classifications array
    $navList = '<ul class="navlist">';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li>
                    <a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])
                    ."' title='View our $classification[classificationName] product line'>
                    $classification[classificationName]</a>
                    </li>";
    }
    $navList .= '</ul>';
    return $navList;
  }

//Build the classification select list
function buildClassificationList($classifications) {
  $classifications = getClassifications();

  $classificationList = '<select name="classificationId" id="classificationList">';
  $classificationList .= "<option>Choose a Classification</option>";
  foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
  }
  $classificationList .= '</select>';
  return $classificationList;
  }

// Build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles, $classificationName) {
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<p><a href='/phpmotors/vehicles/?action=vehicle&invId=".urlencode($vehicle['invId'])."&classificationName=".urlencode($classificationName)."'><img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a></p>";
    $dv .= '<hr>';
    $dv .= "<h2><a href='/phpmotors/vehicles/?action=vehicle&invId=".urlencode($vehicle['invId'])."'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
    $dv .= "<div>$".number_format($vehicle['invPrice'], 2)."</div>";
    $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
  }

function buildVehiclePage($vehicle, $classificationName) {
  $vp = "<div class='detailstop'><h2>$".number_format($vehicle['invPrice'], 2)."</h2>";
  $vp .= "<span class='center'>";
 $vp .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
 $vp .= "</span>";
 $vp .= "</div>";
 $vp .= "<table class='table detailstable' id='inventoryDisplay'>";
 $vp .= "<caption>Vehicle Details</caption>";
 $vp .= "<tr>";
 $vp .= "<th>Make</th><td>$vehicle[invMake]</td>";
 $vp .= "</tr>";
 $vp .= "<tr>";
 $vp .= "<th>Model</th><td>$vehicle[invModel]</td>";
 $vp .= "</tr>";
 $vp .= "<tr>";
 $vp .= "<th>Price</th><td>$".number_format($vehicle['invPrice'], 2)."</td>";
 $vp .= "</tr>";
 $vp .= "<tr>";
 $vp .= "<th>Description</th><td>$vehicle[invDescription]</td>";
 $vp .= "</tr>";
 $vp .= "<tr>";
 $vp .= "<th>Color</th><td>$vehicle[invColor]</td>";
 $vp .= "</tr>";
 $vp .= "<tr>";
 $vp .= "<th>Classification</th><td>$classificationName</td>";
 $vp .= "</tr>";
 $vp .= "<tr>";
 $vp .= "<th>In Stock</th><td>$vehicle[invStock]</td>";
 $vp .= "</tr>";
 $vp .= "</table>";
  return $vp;
  }

function displayThumbnails($thumbnails) {
  $dt = '<h3 class="thumbheader">Thumbnails</h3>';
  $dt .= '<ul class="thumbul float">';
  foreach ($thumbnails as $thumbnail) {
    $dt .= "<li><img class='thumbnail' src='$thumbnail[imgPath]' alt='Thumbnail image'></li>";
  }
  $dt .= '</ul>';
  return $dt;
  }

function buildAdminReviewTable($reviews) {
  $rt = '<ul>';
  foreach ($reviews as $review) {
    $date = $review['reviewdate'];
    $date = date('d F, Y', strtotime($date));
    $rt .= "<li class='reviewlisttop'>$date</li>";
    $rt .= "<li class='reviewlist'>$review[review]</li>";
    $rt .= "<li class='align'><p class='inline'><a class='button' href='/phpmotors/reviews/?action=editview&reviewId=$review[reviewId]&invId=$review[invId]' title='Update this review.'>Update</a></p>";
    $rt .= "<p class='inline'><a class='button' href='/phpmotors/reviews/?action=deleteconfirm&reviewId=$review[reviewId]&invId=$review[invId]' title='Delete this review.'>Delete</a></p></li>";
  }
  $rt .= '</ul>';
  return $rt;
  }

function buildReviewTable($reviews) {
  $rt = '<ul>';
  if ($reviews) {
  foreach ($reviews as $review) {
  $date = $review['reviewdate'];
  $date = date('d F, Y', strtotime($date)); 
  $clientName = getClientById($review['clientId']);
  $reviewerfristname = substr($clientName['clientFirstname'], 0, 1);
  $reviewerlastname = $clientName['clientLastname'];
  $reviewerName = "$reviewerfristname$reviewerlastname";

  $rt .= "<li class='reviewlisttop'>$reviewerName wrote on $date:</li>";
  $rt .= "<li class='reviewlist'>$review[review]</li>";
  } 
} else {
  $rt .= '<p><i>Be the first to write a review.</i></p>';

}
  $rt .= '</ul>';
  return $rt;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
//adds "-tn" designation to file name
function makeThumbnailName($image) {
  $i = strrpos($image, '.');
  $image_name = substr ($image, 0, $i);
  $ext = substr ($image, $i);
  $image = $image_name.'-tn'.$ext;
  return $image;
  }

//build images display for image management view
function buildImageDisplay($imageArray) {
  $id = '<ul id="image-display">';
  foreach ($imageArray as $image) {
    $id .= '<li>';
    $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
    $id .= "<p><a href='/phpmotors/uploads?action=delete&imgid=$image[imgid]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
    $id .= '</li>';
  }
  $id .= '</ul>';
  return $id;
  }

//build the vehicles select list
function buildVehiclesSelect($vehicles) {
  $prodList = '<select name="invId" id="invItem">';
  $prodList .= "<option>Choose a Vehicle</option>";
  foreach ($vehicles as $vehicle) {
    $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
  }
  $prodList .= '</select>';
  return $prodList;
  }

//handles the file upload process and returns the path
//the file path is stored into the database
function uploadFile($name) {
  //gets the paths, full and local directory
  global $image_dir, $image_dir_path;
  if (isset($_FILES[$name])) {
    //gets the actual file name
    $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
      return;
    }
    //get the file from teh temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    //sets the new path - images folder in this directory
    $target = $image_dir_path.'/'.$filename;
    //moves the file to the target folder
    move_uploaded_file($source, $target);
    //send file for further processing
    processImage($image_dir_path, $filename);
    //sets the path for the image for database storage
    $filepath = $image_dir.'/'.$filename;
    //returns the path where the file is stored 
    return $filepath;
  }
  }

//processes images by getting paths and creating smaller versions of the image
function processImage($dir, $filename) {
  //set up the variables
  $dir = $dir.'/';

  //set up the image path
  $image_path = $dir.$filename;

  //set up the thumbnail image path
  $image_path_tn = $dir.makeThumbnailName($filename);

  //create a thumbnail image that's a maximum of 200 pixels squared
  resizeImage($image_path, $image_path_tn, 200, 200);

  //resize the original to a maximum of 500 pixels square
  resizeImage($image_path, $image_path, 500, 500);
  }

//checks and resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
  //get image type
  $image_info = getimagesize($old_image_path);
  $image_type = $image_info[2];

  //set up the function names
  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $image_from_file = 'imagecreatefromjpeg';
      $image_to_file = 'imagejpeg';
      break;
    case IMAGETYPE_GIF:
      $image_from_file = 'imagecreatefromgif';
      $image_to_file = 'imagegif';
      break;
    case IMAGETYPE_PNG:
      $image_from_file = 'imagecreatefrompng';
      $image_to_file = 'imagepng';
      break;
    default: 
    return;
  } //ends the switch
  //get the old image and its height and width
  $old_image = $image_from_file($old_image_path);
  $old_width = imagesx($old_image);
  $old_height = imagesy($old_image);

  //calculate height and width ratios
  $width_ratio = $old_width / $max_width;
  $height_ratio = $old_height / $max_height;

  //if image is larger than specified ratio, create the new image
  if ($width_ratio > 1 || $height_ratio > 1) {
    //calculate height and width for the new image
    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);

    //create the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);

    //set transparency according to image type
    if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
    }

    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
    }

    //copy old image to new image - this resized the image
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

    // write the new image to a new file
    $image_to_file($new_image, $new_image_path);
    //free any memory associated with the new image
    imagedestroy($new_image);
  } else {
    //write the old image to a new file
    $image_to_file($old_image, $new_image_path);
  }
  //free any memory associated with the old image
  imagedestroy($old_image);
  } // ends resizeImage function
?>