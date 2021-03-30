<?php 
if (!$_SESSION['loggedin'])
{
  header('Location: ../index.php');
  exit;
}

include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; 
?>

<main>
  <h1><?php echo $_SESSION['clientData']['clientFirstname']; echo " ".$_SESSION['clientData']['clientLastname']; ?></h1>

  <p>You are logged in.</p>

<?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];} ?>

  <ul>
    <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
    <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
    <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
  </ul>

  <h2>Account Management</h2>
  <p>Use this link to update account information.</p>
  <p><a href="/phpmotors/accounts/index.php?action=getClientById&clientId=<?php echo $_SESSION['clientData']['clientId']; ?>">Update Account Information</a></p>

  <?php 
  if ($_SESSION['clientData']['clientLevel'] > 1)
  {
    echo "<h2>Inventory Management</h2>
          <p>Use this link to manage the inventory.</p>
          <p><a href='/phpmotors/vehicles/index.php?action='>Vehicle Management</a></p>";
  }
  ?>

<h2>Reviews</h2>
<?php if (isset($_SESSION['reviewmessage'])) {
  echo $_SESSION['reviewmessage'];
}
echo $rt ?>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; 

unset($_SESSION['message']);
?>