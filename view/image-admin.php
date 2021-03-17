<?php
if(isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
$imageadmin = $_SESSION['imageadmin'];
include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php';
?>

<main>
  <h1>Image Management</h1>
  <p>Welcome to the image management page. Please choose an option below:</p>
  <h2>Add New Vehicle Image</h2>
  <?php if (isset($message)) {
    echo $message;
  } ?>

  <form action="/phpmotors/uploads/" method="POST" enctype="multipart/form-data">
    <label for="invItem">Vehicle</label><br>
    <?php echo $prodSelect; ?><br><br>
    <fieldset>
      <label>Is this the main image for the vehicle?</label><br>
      <label for="priYes" class="pImage">Yes</label>
      <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
      <label for="priNo" class="pImage">No</label>
      <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
    </fieldset><br>
    <label>Upload Image:</label>
    <input type="file" name="file1"><br><br>
    <input type="submit" class="regbtn" value="Upload">
    <input type="hidden" name="action" value="upload">
  </form><br><br>
  <hr>
  <h2>Existing Images</h2>
  <p class="error">If deleting an image, delete the thumbnail too and vice versa.</P>
  <?php if (isset($imageDisplay)) {
    echo $imageDisplay;
  } ?>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php';
unset($_SESSION['message']);
unset($_SESSION['imageadmin']); ?>