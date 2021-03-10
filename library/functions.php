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
    $dv .= "<p><a href='/phpmotors/vehicles/?action=vehicle&invId=".urlencode($vehicle['invId'])."&classificationName=".urlencode($classificationName)."'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a></p>";
    $dv .= '<hr>';
    $dv .= "<h2><a href='/phpmotors/vehicles/?action=vehicle&invId=".urlencode($vehicle['invId'])."'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
    $dv .= "<div>$vehicle[invPrice]</div>";
    $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
}

function buildVehiclePage($vehicle, $classificationName) {
  $vp = "<h2>$".number_format($vehicle['invPrice'], 2)."</h2>";
  $vp .= "<div>";
  $vp .= "<span class='float center'>";
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
?>