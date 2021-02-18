<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Register For An Account</h1>

<?php
if (isset($message))
{
  echo $message;
}
?>

  <form action="/phpmotors/accounts/index.php" method="POST">
    <p>*All fields required</p>
    <label for="fname">First Name: </label><br>
    <input name="clientFirstname" id="fname" type="text" <?php if (isset($clientFirstname)) {echo "value='$clientFirstname'";} ?> required><br><br>
    <label for="lname">Last Name: </label><br>
    <input name="clientLastname" id="lname" type="text" <?php if (isset($clientLastname)) {echo "value='$clientLastname'";} ?> required><br><br>
    <label for="email">Email: </label><br>
    <input name="clientEmail" id="email" type="email" <?php if (isset($clientEmail)) {echo "value='$clientEmail'";} ?> required><br><br>
    <label for="password">Password: </label><br>
    <span class="passrequirements">
      <ul>
        <li>at least 8 characters</li>
        <li>1 uppercase character</li>
        <li>1 number</li>
        <li>1 special character</li>
      </ul>
    </span>
    <input name="clientPassword" id="password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>
    <input type="submit" name="submit" id="regbtn" value="Register">

    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="register">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>