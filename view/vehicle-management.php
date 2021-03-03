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

  <a href="/phpmotors/vehicles/index.php?action=addclassification" title="Add a classification to the car classifications list.">Add a Classification</a>
  <br><br>
  <a href="/phpmotors/vehicles/index.php?action=addvehicle" title="Add a vehicle to the inventory list.">Add a Vehicle</a>

  <?php
  if (isset($message)) {
    echo $message;
  }
  if (isset($classificationList)) {
    echo '<h2>Vehicles By Classification</h2>';
    echo '<p>Choose a classification to see those vehicles.</p>';
    echo $classificationList;
  }
  ?>
  <noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
  </noscript>
  <table id="inventoryDisplay"></table>
</main>

<script src="../js/inventory.js">
<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>