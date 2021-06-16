<?php
/*
* Proxy connection to the phpmotors database
*/

function phpmotorsConnect()
{
    // $server = 'mysql';
    // $dbname = 'phpmotors';
    // $username = 'iClient';
    // $password ='Yw6hd7Higiovk5pX';

    // $dsn = "mysql:host=$server;dbname=$dbname";
    // $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // //Create connection object and assign it to a variable
    // try {
    //     $link = new PDO($dsn, $username, $password, $options);
    //     // if(is_object($link)) {
    //     //   echo 'It worked!';
    //     // }
    //     return $link;
    // } catch (PDOException $e) {
    //     //  echo "It didn't work, error: ".$e->getMessage();
    //     header('Location: /phpmotors/view/500.php');
    //     exit;
    // }

      $db = NULL;
    
      try {
        // default Heroku Postgres configuration URL
        $dbUrl = getenv('DATABASE_URL');
    
        // Get the various parts of the DB Connection from the URL
        $dbopts = parse_url($dbUrl);
    
        $dbHost = $dbopts["host"];
        $dbPort = $dbopts["port"];
        $dbUser = $dbopts["user"];
        $dbPassword = $dbopts["pass"];
        $dbName = ltrim($dbopts["path"],'/');
    
        // Create the PDO connection
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
        // this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      }
      catch (PDOException $ex) {
        // If this were in production, you would not want to echo
        // the details of the exception.
        echo "Error connecting to DB. Details: $ex";
        die();
      }
    
      return $db;
    
}
?>