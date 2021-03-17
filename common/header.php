<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
  <?php
  if (isset($invInfo['invMake']) && isset($invInfo['invModel']) && !isset($_SESSION['delete'])) {
    echo "Modify $invInfo[invMake] $invInfo[invModel] | PHP Motors";
  } elseif (isset($invMake) && isset($invModel) && !isset($_SESSION['delete'])) {
    echo "Modify $invMake $invModel | PHP Motors";
  } elseif (isset($_SESSION['delete']) && isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
    echo "Delete $invInfo[invMake] $invInfo[invModel] | PHP Motors";
  } elseif (isset($classificationName) && isset($make) && isset($model)) {
    echo "$make $model Details | PHP Motots";
  } elseif (isset($classificationName)) {
    echo "$classificationName | PHP Motors";
  } elseif (isset($imageadmin)) {
    echo "Image Management | PHP Motors";
  } else {
    echo 'PHP Motors';
  }
  ?>
  </title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
  <link href="/phpmotors/css/main.css" type="text/css" rel="stylesheet" media="screen">
</head>

<body>
  <header>
    <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
<div class='logdiv'>
<?php
    $clientFirstName = $_SESSION['clientData']['clientFirstname'];
    if (isset($_SESSION['loggedin']))
    {
      echo "<a class='loginout' href='/phpmotors/accounts/'>Welcome $clientFirstName</a><br>";
    }
    ?>

    <a class='loginout
    <?php if (isset($_SESSION['loggedin']))
    {
      echo ' hidden';
    }
    ?>
     ' href="/phpmotors/accounts/index.php?action=login" title="Login in to PHP Motors">My Account</a>
     <a class="loginout
     <?php if (!isset($_SESSION['loggedin']))
     {
       echo ' hidden';
     }
     ?>
     " href="/phpmotors/accounts/index.php?action=Logout" title="Logout of PHP Motors">Logout</a>
</div>    
    
  </header>

  <nav>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/nav.php';?>
  </nav>