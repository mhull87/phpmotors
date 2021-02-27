<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Log Into PHP Motors</h1>

  <?php
if (isset($message))
{
  echo $message;
}
if (isset($_SESSION['message']))
{
  echo $_SESSION['message'];
}
?>

  <form action="/phpmotors/accounts/" method="POST">
    <label for="email">Email: </label><br>
    <input name="clientEmail" id="email" type="email" <?php if (isset($clientEmail)) {echo "value='$clientEmail'";} ?> required><br><br>
    <label for="password">Password: </label>
    <div class="passrequirements">
      <ul>
        <li>at least 8 characters</li>
        <li>1 uppercase character</li>
        <li>1 number</li>
        <li>1 special character</li>
      </ul>
    </div>
    <input name="clientPassword" id="password" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>
    <input type="submit" value="Login">
    <input type="hidden" name="action" value="Login">
  </form><br>
  <a href="/phpmotors/accounts/index.php?action=register" title="Register for a PHP Motors account.">Not a member yet?</a>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>