<?php
//Main PHP Motors Model
function getClassifications()
{
    //Create a connection object form the phpmotors conncetion function
    $db = phpmotorsConnect();
    //The SQL statement to be used with the database
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC';
    //The next line creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The next line runs the prepared statement
    $stmt->execute();
    //The next line gets the data from the database and stores it as an array in the $classifications variable
    $classifications = $stmt->fetchAll();
    //The net line closes the interaction with the database
    $stmt->closeCursor();
    //The next line sends the array of data back to where the function was called (this should be the controller)
    return $classifications;
}