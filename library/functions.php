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
function buildVehiclesDisplay($vehicles) {
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<p><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></p>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<div>$vehicle[invPrice]</div>";
    $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
}
?>