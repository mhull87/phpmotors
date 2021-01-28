<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Register For An Account</h1>
  <form action="#" method="POST">
    <p>*All fields required*</p>
    <label for="firstname">First Name: </label><br>
    <input name="firstname" id="firstname" type="text"><br>
    <label for="lastname">Last Name: </label><br>
    <input name="lastname" id="lastname" type="text"><br>
    <label for="email">Email: </label><br>
    <input name="email" id="email" type="email"><br>
    <label for="password">Password: </label><br>
    <input name="password" id="password" type="password"><br><br>
    <input type="submit" value="Register">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>