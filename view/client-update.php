<?php 
if (!$_SESSION['loggedin'])
{
  header('Location: ../index.php');
  exit;
}

include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Update Account</h1>

<?php
if (isset($_SESSION['infomessage']))
{
  echo $_SESSION['infomessage'];
}
if (isset($message)) {
  echo $message;
}
?>

<h2>Update Information</h2>
  <form action="/phpmotors/accounts/index.php" method="POST">
    <label for="fname">First Name: </label><br>
    <input name="clientFirstname" id="fname" type="text" <?php if (isset($clientFirstname)) {echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'";} ?> required><br><br>

    <label for="lname">Last Name: </label><br>
    <input name="clientLastname" id="lname" type="text" <?php if (isset($clientLastname)) {echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'";} ?> required><br><br>

    <label for="email">Email: </label><br>
    <input name="clientEmail" id="email" type="email" <?php if (isset($clientEmail)) {echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'";} ?> required><br><br>

    <input type="submit" value="Update Client">
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="updateClient">
    <input type="hidden" name="clientId" value="<?php if (isset($clientInfo['clientId'])) {echo $clientInfo['clientId'];} elseif(isset($clientId)) {echo $clientId;} ?>">
  </form>

  <?php
if (isset($_SESSION['passmessage']))
{
  echo $_SESSION['passmessage'];
}
?>
 <h2>Update Password</h2>
  <form>
    <label for="password">New Password: </label><br>
    <div class="passrequirements">
      <ul>
        <li>at least 8 characters</li>
        <li>1 uppercase character</li>
        <li>1 number</li>
        <li>1 special character</li>
      </ul>
    </div>
    <p class='error'>*Note: your original password will be changed.</p>
    <input name="clientPassword" id="password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>

    <input type="submit" name="submit" id="regbtn" value="Update Password">

    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="updatePassword">
    <input type="hidden" name="clientId" value="<?php if (isset($clientInfo['clientId'])) {echo $clientInfo['clientId'];} elseif(isset($clientId)) {echo $clientId;} ?>">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>

<script src="../js/accounts.js"></script>