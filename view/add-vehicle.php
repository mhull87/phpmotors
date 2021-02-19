<?php
    $classificationOptions = '';
    //Create a dynamic drop-down select list
    foreach ($classifications as $classification) 
    {
    $classificationOptions .= "<option value='$classification[classificationId]'";

    if (isset($classificationId))
      {
        if ($classification['classificationId'] === $classificationId)
          {
            $classificationOptions .= ' selected ';
          }
      }
    
    $classificationOptions .= ">$classification[classificationName]</option>";
    }
?><?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

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

    <label for='classificationList'>Choose a Vehicle:</label><br>
    <select name='classificationList' id='classificationList' <?php if (isset($classificationName)) {echo "value='$classificationName'";} ?> >

      <?php echo $classificationOptions; ?>
    
    </select><br><br>

    <label for="invMake">Make</label><br>
    <input name="invMake" id="invMake" type="text" <?php if (isset($invMake)) {echo "value='$invMake'";} ?> required><br><br>

    <label for="invModel">Model</label><br>
    <input name="invModel" id="invModel" type="text" <?php if (isset($invModel)) {echo "value='$invModel'";} ?> required><br><br>

    <label for="invDescription">Description</label><br>
    <textarea name="invDescription" id="invDescription" rows="6" cols="20" required><?php if (isset($invDescription)) {echo $invDescription;} ?></textarea><br><br>

    <label for="invImage">Image Path</label><br>
    <input name="invImage" id="invImage" type="text" value="../images/no-image.png" <?php if (isset($invImage)) {echo "value='$invImage'";} ?> required><br><br>

    <label for="invThumbnail">Thumbnail Path</label><br>
    <input name="invThumbnail" id="invThumbnail" type="text" value="../images/no-image.png" <?php if (isset($invThumbnail)) {echo "value='$invThumbnail'";} ?> required><br><br>

    <label for="invPrice">Price</label><br>
    $<input name="invPrice" id="invPrice" type="text" placeholder='1200.00' pattern="^\d+(?:\.\d{2})$" <?php if (isset($invPrice)) {echo "value='$invPrice'";} ?> required><br><br>

    <label for="invStock"># In Stock</label><br>
    <input name="invStock" id="invStock" type="text" <?php if (isset($invStock)) {echo "value='$invStock'";} ?> required><br><br>

    <label for="invColor">Color</label><br>
    <input name="invColor" id="invColor" type="color" <?php if (isset($invColor)) {echo "value='$invColor'";} ?> required><br><br>

    <input type="submit" id="addvehiclebtn" value="Add Vehicle"><br>

    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="addvehicle">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>