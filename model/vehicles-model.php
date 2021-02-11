<?php
//This is the vehicles model

//The first function will handle adding new classifications to the carclassifications table

//The second function will handle adding a new vehicle to the inventory table


function newClassification($classificationName)
{
  //Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  //The SQL statement
  $sql = 'INSERT INTO carclassification (classificationName)
          VALUES (:classificationName)';
//Create the prepared statement using the phpmotors connection
$stmt = $db->prepare($sql);
//Replace the placeholder in the SQL
//statement with the actual values in the variables
//and tells the database the type of data it is
$stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
//Insert the data
$stmt->execute();
//Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
//Close the database interaction
$stmt->closeCursor();
//return the indication of success (rows changed)
return $rowsChanged;
}

function addVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor)
{
  //Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  //The SQL statement
  $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor)
    VALUES (:classificationId, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor)';
  //Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  //Then next seven lines replace the placeholders in the SQL
  //statement with the acutal values in the variables
  //and tells the database the type of data it is
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);

//Insert the data
$stmt->execute();
//Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
//Close the database
$stmt->closeCursor();
//Return the indication of success (rows changed)
return $rowsChanged;
}

?>