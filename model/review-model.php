<?php
function insertReview($clientId, $invId, $review) {
  $db = phpmotorsConnect();

  $sql = 'INSERT INTO reviews (clientId, invId, review) 
  VALUES (:clientId, :invId, :review)';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':review', $review, PDO::PARAM_STR);

  $stmt->execute();
  $stmt->closeCursor();
  }

function getReviewsByInvId($invId) {
  $db = phpmotorsConnect();

  $sql = 'SELECT * FROM reviews WHERE invId=:invId ORDER BY reviewId desc';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $reviews;
  }

function getReviewsByClientId($clientId) {
  $db = phpmotorsConnect();

  $sql = 'SELECT * FROM reviews WHERE clientId=:clientId ORDER BY reviewId desc';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $reviews;
  }

function getReview($reviewId) {
  $db = phpmotorsConnect();

  $sql = 'SELECT * FROM reviews WHERE reviewId=:reviewId';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $review = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $review;
  }

function updateReview($review, $reviewId) {
  $db = phpmotorsConnect();

  $sql = 'UPDATE reviews SET review=:review WHERE reviewId=:reviewId';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':review', $review, PDO::PARAM_STR);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
  }

function deleteReview($reviewId) {
  $db = phpmotorsConnect();

  $sql = 'DELETE FROM reviews WHERE reviewId=:reviewId';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
  }
  function getVehicleByInvId($invId) {
    $db = phpmotorsConnect();

    $sql = 'SELECT invMake, invModel FROM inventory WHERE invId=:invId';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicle;
  }
?>