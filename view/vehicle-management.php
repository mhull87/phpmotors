<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2)
{
  header('Location: ../index.php');
  exit;
}

include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; 
?>

<main>
  <h1>Vehicle Management</h1>

  <?php
  if (isset($message))
  {
    echo $message;
  }
  ?>

  <a href="/phpmotors/vehicles/index.php?action=addclassification" title="Add a classification to the car classifications list.">Add a Classification</a>
  <br><br>
  <a href="/phpmotors/vehicles/index.php?action=addvehicle" title="Add a vehicle to the inventory list.">Add a Vehicle</a>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>