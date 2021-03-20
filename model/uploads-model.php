<?php //this is the model for the vehicle inventory image uploads
//add image information to the database table
function storeImages ($imgPath, $invId, $imgName, $imgPrimary) {
  $db = phpmotorsConnect();
  $sql = 'INSERT INTO images (invId, imgPath, imgName, imgPrimary)
          VALUES (:invId, :imgPath, :imgName, :imgPrimary)';
  $stmt = $db->prepare($sql);
  //store the full size image information
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
  $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
  $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
  $stmt->execute();

  //make and store the thumbnail image information
  //change name in path
  $imgPath = makeThumbnailName($imgPath);
  //change name in file name
  $imgName = makeThumbnailName($imgName);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
  $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
  $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
  }

//get image information from images table
function getImages() {
  $db = phpmotorsConnect();
  $sql = 'SELECT imgid, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invid = inventory.invId';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $imageArray;
  }

// Delete image information from the images table
function deleteImage($imgId) {
  $db = phpmotorsConnect();
  $sql = 'DELETE FROM images WHERE imgid = :imgId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->rowCount();
  $stmt->closeCursor();
  return $result;
 }

//check for an existing image
function checkExistingImage($imgName) {
  $db = phpmotorsConnect();
  $sql = "SELECT imgName FROM images WHERE imgName = :name";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
  $stmt->execute();
  $imageMatch = $stmt->fetch();
  $stmt->closeCursor();
  return $imageMatch;
  }
?>