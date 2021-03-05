<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2)
{
  header('Location: ../index.php');
  exit;
}

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
      } elseif (isset($invInfo['classificationId']))
      {
        if ($classification['classificationId'] === $invInfo['classificationId'])
        {
          $classificationOptions .= ' selected';
        }
      }
    $classificationOptions .= ">$classification[classificationName]</option>";
    }
    
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1>
  <?php
  if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
    echo "Modify $invInfo[invMake] $invInfo[invModel]";
  } elseif (isset($invMake) && isset($invModel)) {
    echo "Modify $invMake $invModel";
  }
  ?>
  </h1>

  <?php
  if (isset($message))
  {
    echo $message;
  }
  ?>

  <form action="/phpmotors/vehicles/index.php" method="POST">
    <p>*All fields required</p>

    <label for='classificationList'>Vehicle Classification</label><br>
    <select name='classificationList' id='classificationList' <?php if (isset($classificationName)) {echo "value='$classificationName'";} ?> >
    <option>Choose a Classification</option>

      <?php echo $classificationOptions; ?>
    
    </select><br><br>

    <label for="invMake">Make</label><br>
    <input name="invMake" id="invMake" type="text" <?php if (isset($invMake)) {echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?> required><br><br>

    <label for="invModel">Model</label><br>
    <input name="invModel" id="invModel" type="text" <?php if (isset($invModel)) {echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?> required><br><br>

    <label for="invDescription">Description</label><br>
    <textarea name="invDescription" id="invDescription" rows="6" cols="20" required><?php if (isset($invDescription)) {echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription'];} ?></textarea><br><br>

    <label for="invImage">Image Path</label><br>
    <input name="invImage" id="invImage" type="text" <?php if (isset($invImage)) {echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'";} ?> required><br><br>

    <label for="invThumbnail">Thumbnail Path</label><br>
    <input name="invThumbnail" id="invThumbnail" type="text" <?php if (isset($invThumbnail)) {echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'";} ?> required><br><br>

    <label for="invPrice">Price</label><br>
    $<input name="invPrice" id="invPrice" type="text" placeholder='1200.00' pattern="^\d+(?:\.\d{2})$" <?php if (isset($invPrice)) {echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'";} ?> required><br><br>

    <label for="invStock"># In Stock</label><br>
    <input name="invStock" id="invStock" type="text" <?php if (isset($invStock)) {echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'";} ?> required><br><br>

    <label for="invColor">Color</label><br>
    <input name="invColor" id="invColor" type="text" <?php if (isset($invColor)) {echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'";} ?> required><br><br>

    <input type="submit" id="modifyvehiclebtn" value="Modify Vehicle"><br>

    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="
    <?php if (isset($invInfo['invId'])) {echo $invInfo['invId'];} elseif(isset($invId)) {echo $invId;} ?>">
  </form>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>