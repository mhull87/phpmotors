<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors</title>
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