<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1><?php echo "$make $model" ?></h1>
  <?php if (isset($message)) {
    echo $message; 
  } ?>

<div  class='detailscontainer'>
  <?php if (isset($vehiclePage)) {
    echo $vehiclePage;
    echo $displayThumbnails;
  } ?>
  </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>