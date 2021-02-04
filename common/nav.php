<?php
//Get the array of classifications
$classifications = getClassifications();

//Build a navigation bar using the $classifications array
$navList = '<ul class="navlist">';
$navList .= "<li><a href='/phpmotors/index.php?action=home' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}

$navList .= '</ul>';

echo $navList; 

?>
