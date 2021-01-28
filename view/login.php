<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Log Into PHP Motors</h1>

  <form action="#" method="POST">
    <label for="email">Email: </label><br>
    <input name="email" id="email" type="email"><br>
    <label for="password">Password: </label><br>
    <input name="password" id="password" type="password"><br><br>
    <input type="submit" value="Login">
  </form><br>
  <a href="registration.php">Not a member yet?</a>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>