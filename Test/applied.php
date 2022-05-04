<?php 
include 'template.php';
require_once "config.php";

if(isset($_POST['dapplied'])){
    $id=(int) $_POST['myid'];

    // sql to delete a record
    $sql = "DELETE FROM candidates WHERE id=".$id;

    if ($conn->query($sql) === TRUE) {
       
    } else {
        echo "Error deleting record: " . $conn->error;
    }
     
   
  }
 

?>
<style>
  body{
    
  }
  #applicants{
    margin-left:80px;
    width:90%;
    border:2px solid blue;
  }

  #applicants th{
    border:2px solid blue;
    text-align:center;
  }
  #applicants tr:hover {background-color: #D6EEEE;}
  #applicants td{
    border:2px solid blue;
  }
</style>

<table class="table" id="applicants">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">S.No</th>
      <th scope="col">Candidate Name</th>
      <th scope="col"><i class="fas fa-envelope-open"></i> Email</th>
      <th scope="col">Mobile No</th>
      <th scope="col">place</th>
      <th scope="col">applied for</th>
    </tr>
  </thead>
  <tbody>
     <?php  
       require_once "config.php";

      $sql="SELECT `id`, `name`, `email`, `mobileNo`, `place`, `applyingFor` FROM `candidates`";
    
      $result = mysqli_query($conn,$sql);       

        if($result->num_rows>0){
           $i=0;
           while($rows=$result->fetch_assoc()){
             
            
            echo "<tr>".
                   "<td>".++$i."</td>
                   <td>".$rows['name']."</td>
                   <td>".$rows['email']."</td>
                   <td>".$rows['mobileNo']."</td>
                   <td>".$rows['place']."</td>
                   <td>".$rows['applyingFor']."</td>".
                   "<td><span class='deleteMember'>
                   <form action='' method='post'>
                       <input type='hidden' name='myid' value='".$rows['id']."' />
                       <button type='submit' name='dapplied' onClick='note()'><i class='fas fa-trash-alt' style='color:red;'></i></button>
                   </form>
               </span></td>".
                   "</tr>";
                   
           }
        }
     ?>
  </tbody>
</table>

<script>

function note(){
  alert("This application is removed!!");
}
  </script>
