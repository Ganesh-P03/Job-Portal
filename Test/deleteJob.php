<?php

if(isset($_POST['djob'])){
    $id=(int) $_POST['myid'];

    // sql to delete a record
    $sql = "DELETE FROM jobs WHERE id=".$id;

    if ($conn->query($sql) === TRUE) {
       
    } else {
        echo "Error deleting record: " . $conn->error;
    }
     
    $query = "SET  @num := 0;";

   
$query .= "UPDATE jobs SET id = @num := (@num+1);"; /* Notice the dot before = and the 2 semicolons at the end ! */

$query .= "ALTER TABLE jobs AUTO_INCREMENT = 1";
mysqli_multi_query($conn, $query);

  }
 
?>

