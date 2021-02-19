<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Add a Vehicle Classification</h1>

  <?php
  if (isset($message))
  {
    echo $message;
  }
  ?>

  <form action="/phpmotors/vehicles/index.php" method="POST">
    <label for="classificationName">Classification Name</label><br>
    <input name="classificationName" id="classificationName" type="text" required><br><br>
    <input type="submit" name="submit" id="classbtn" value="Add Car Classification">

    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="addclassification">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>