<?php 
if (!$_SESSION['loggedin'])
{
  header('Location: ../index.php');
  exit;
}

include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; 

?>

<main>
  <h1><?php echo  $_SESSION['clientData']['clientFirstname']; echo " ".$_SESSION['clientData']['clientLastname']; ?></h1>

  <ul>
    <li>ClientId: <?php echo $_SESSION['clientData']['clientId']; ?></li>
    <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
    <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
    <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
    <li>Client Level: <?php echo $_SESSION['clientData']['clientLevel']; ?></li>
  </ul>

  <?php 
  if ($_SESSION['clientData']['clientLevel'] > 1)
  {
    echo "<p><a href='/phpmotors/vehicles/index.php?action='>Vehicle Management</a></p>";
  }
  ?>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>