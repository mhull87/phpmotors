<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>

<main>
  <h1><?php echo "$make $model" ?></h1>
  <?php if (isset($message)) {
    echo $message; 
  } ?>

  <?php if (isset($vehiclePage)) {
    echo $vehiclePage;
  } ?>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>