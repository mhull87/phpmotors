<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>Add a Vehicle</h1>

  <?php
  if (isset($message))
  {
    echo $message;
  }
  ?>

  <form action="/phpmotors/vehicles/index.php" method="POST">
    <p>*All fields required</p>
    <?php echo $classificationList; ?><br><br>
    <label for="invMake">Make</label><br>
    <input name="invMake" id="invMake" type="text"><br><br>
    <label for="invModel">Model</label><br>
    <input name="invModel" id="invModel" type="text"><br><br>
    <label for="invDescription">Description</label><br>
    <textarea name="invDescription" id="invDescription" rows="6" cols="20"></textarea><br><br>
    <label for="invImage">Image Path</label><br>
    <input name="invImage" id="invImage" type="text"><br><br>
    <label for="invThumbnail">Thumbnail Path</label><br>
    <input name="invThumbnail" id="invThumbnail" type="text"><br><br>
    <label for="invPrice">Price</label><br>
    <input name="invStock" id="invStock" type="text"><br><br>
    <label for="invColor">Color</label><br>
    <input name="invColor" id="invColor" type="text"><br><br>
    <input type="submit" id="addvehiclebtn" value="Add Vehicle"><br>

    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="addvehicle">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>