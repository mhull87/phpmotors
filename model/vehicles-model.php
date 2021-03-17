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

//Get vehicles by classificationId
function getInventoryByClassification($classificationId) {
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
  $stmt->execute();
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $inventory;
}

//Get vehicle information by invId
function getInvItemInfo($invId) {
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}

//update a vehicle in the inventory
function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId)
{
  //Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  //The SQL statement
  $sql = 'UPDATE inventory SET classificationId = :classificationId, invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor WHERE invId = :invId';
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
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

//Insert the data
$stmt->execute();
//Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
//Close the database
$stmt->closeCursor();
//Return the indication of success (rows changed)
return $rowsChanged;
}

//delete a vehicle from the inventory list
function deleteVehicle($invId)
{
  //Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  //The SQL statement
  $sql = 'DELETE FROM inventory WHERE invId = :invId';
  //Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  //Then next seven lines replace the placeholders in the SQL
  //statement with the acutal values in the variables
  //and tells the database the type of data it is
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

//Insert the data
$stmt->execute();
//Ask how many rows changed as a result of our insert
$rowsChanged = $stmt->rowCount();
//Close the database
$stmt->closeCursor();
//Return the indication of success (rows changed)
return $rowsChanged;
}

function getVehiclesByClassification($classificationName) {
  $db = phpmotorsConnect();
  $sql = 'SELECT invId, invMake, invModel, invDescription, invImage, invPrice, invStock, invColor, classificationId FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;
}

// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

function getPrimaryImage($invId) {
  $db = phpmotorsConnect();
  $sql = 'SELECT imgPath FROM images JOIN inventory ON images.invId = inventory.invId WHERE invId = :invId AND imgPrimary = 1';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $primary = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $primary;
}

function getThumbnail($invId) {
  $db = phpmotorsConnect();
  $sql = 'SELECT imgPath FROM images JOIN inventory ON images.invId = inventory.invId WHERE imgName LIKE "%-tn%" AND imgPrimary = 0';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $thumbnail = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $thumbnail;
}
?>