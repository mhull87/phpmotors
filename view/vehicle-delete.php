<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2)
{
  header('Location: ../index.php');
  exit;
}
    
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>
    <?php
  if (isset($invInfo['invMake'])) {
    echo "Delete $invInfo[invMake] $invInfo[invModel]";
  }
  ?>
  </h1>

  <?php
  if (isset($message))
  {
    echo $message;
  }
  ?>

  <form action="/phpmotors/vehicles/index.php" method="POST">
    <p>Confirm Vehicle Deletion. The delete is permanent.</p>
    <fieldset>
      <legend class='error'>Delete</legend>
      <label for="invMake">Make</label><br>
      <input name="invMake" id="invMake" type="text"
        <?php if (isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?> readonly><br><br>

      <label for="invModel">Model</label><br>
      <input name="invModel" id="invModel" type="text"
        <?php if (isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?> readonly><br><br>

      <label for="invDescription">Description</label><br>
      <textarea name="invDescription" id="invDescription"
        readonly><?php if (isset($invInfo['invDescription'])) {echo $invInfo['invDescription'];} ?></textarea><br><br>

      <input type="submit" id="deletevehiclebtn" value="Delete Vehicle"><br>

      <!-- Add the action name - value pair -->
      <input type="hidden" name="action" value="deleteVehicle">
      <input type="hidden" name="invId" value="
    <?php if (isset($invInfo['invId'])) {echo $invInfo['invId'];} ?>">
    </fieldset>
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; 

unset($_SESSION['delete']);

?>

