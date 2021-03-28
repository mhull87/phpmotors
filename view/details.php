<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; 

$clientData = $_SESSION['clientData'];?>

<main>
  <h1><?php echo "$make $model" ?></h1>
  <?php if (isset($message)) {
    echo $message; 
  } ?>

  <div class='detailscontainer'>
    <?php if (isset($vehiclePage)) {
    echo $vehiclePage;
    echo $displayThumbnails;
  } ?>
  </div>

  <div class="reviewhr">
    <h2>Customer Reviews</h2>

    <p><i>Be the first to write a review.</i></p>
  </div>

  <?php if ($_SESSION['loggedin']) {
  echo "<h3>Review the $vehicle</h3>
  <form action='/phpmotors/vehicles/?action=review' method='POST'>
    <label for='screenname'>Screen Name: </label><br>
    <input id='screenname' type='text' value='$screenName' readonly><br><br>
    <label for='textarea'>Review: </label><br>
    <textarea id='textarea' class='review' rows='6' name='review'></textarea><br><br>
    <input type='submit' value='Submit Review'>
    <input type='hidden' name='clientId' value='$clientData[clientId]'>
    <input type='hidden' name='invId' value='$invId'>
  </form>";
  } else {
    echo "<p>You must <a href='/phpmotors/accounts/?action=login'
        title='Login to your account to write a review.'>login</a> to write a review.</p>";
    }
    ?>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>