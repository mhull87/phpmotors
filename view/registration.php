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
    <p>*All fields required*</p>
    <label for="fname">First Name: </label><br>
    <input name="clientFirstname" id="fname" type="text"><br>
    <label for="lname">Last Name: </label><br>
    <input name="clientLastname" id="lname" type="text"><br>
    <label for="email">Email: </label><br>
    <input name="clientEmail" id="email" type="email"><br>
    <label for="password">Password: </label><br>
    <input name="clientPassword" id="password" type="password"><br><br>
    <input type="submit" name="submit" id="regbtn" value="Register">

    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="register">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>