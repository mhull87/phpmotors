<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php';
?>

<main>
  <h1>
    <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
      echo "Update Review For $invInfo[invMake] $invInfo[invModel]";
    } elseif (isset($invMake) && isset($invModel)) {
      echo "Update Review For $invMake $invModel";
    } ?>
  </h1>

<?php if (isset($message)) {
  echo $message;
} ?>
<p>Reviewed on <?php if (isset($date)) {echo $date;} elseif (isset($_SESSION['sessionreviewdate'])) {echo $_SESSION['sessionreviewdate'];}?></p>

<form action="/phpmotors/reviews/" method="POST">
<label for="textarea">Review Text</label><br>
<textarea id='textarea' class='review' rows='6' name="review" required><?php if(isset($reviewText)) {echo $reviewText;} elseif (isset($_SESSION['sessionreview'])) {echo $_SESSION['sessionreview'];} ?></textarea><br><br>
<input type="hidden" name="action" value="updatereview">
<input type="hidden" name="reviewId" value="<?php echo $reviewId ?>">
<input type="submit" value="Update">
</form>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; 
unset($_SESSION['message']);
unset($_SESSION['reviewmessage']);
?>