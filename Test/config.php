<?php

$server='localhost';
$password='';
$username='root';
$database='new_jobs';


// Create connection
$conn = mysqli_connect($server, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql="ALTER TABLE jobs AUTO_INCREMENT = 1";
//mysqli_query($conn, $sql)
// $name = $_POST['nm'];
// $email = $_POST['em'];
// $mobileNo = $_POST['num'];
// $Password = $_POST['password'];

// echo "Your Name is ".$name.$email.$mobileNo.$Password;

// $sql="ALTER TABLE registered AUTO_INCREMENT = 1;";

// if(mysqli_query($conn, $sql)){
//   echo "<h3>data stored in a database successfully." 
//       . " Please browse your localhost php my admin" 
//       . " to view the updated data</h3>"; 

// } else{
//   echo "ERROR: Hush! Sorry $sql. " 
//       . mysqli_error($conn);
// }


// mysqli_close($conn);


?>




  
