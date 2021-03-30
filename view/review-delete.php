<?php
   
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>
    <?php
  if (isset($invInfo['invMake'])) {
    echo "Delete Review For $invInfo[invMake] $invInfo[invModel]";
  }
  ?>
  </h1>

  <?php
  if (isset($message))
  {
    echo $message;
  }
  ?>

  <form action="/phpmotors/reviews/" method="POST">
    <p>Confirm Vehicle Review Deletion. The delete is permanent.</p>
    <fieldset>
      <legend class='error'>Delete</legend>
      <label for="date">Date</label><br>
      <input name="date" id="date" type="text" value="<?php echo $date ?>" readonly><br><br>

      <label for="review">Review Text</label><br>
      <input name="review" id="review" type="text" value="<?php echo $reviewText ?>" readonly><br><br>

      <input type="submit" id="btn" value="Delete Vehicle Review"><br>

      <!-- Add the action name - value pair -->
      <input type="hidden" name="action" value="deletereview">
      <input type="hidden" name="reviewId" value="<?php echo $reviewId ?>">
    </fieldset>
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; 

unset($_SESSION['delete']);

?>