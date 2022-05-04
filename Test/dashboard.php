<?php 
include 'template.php';
?>

<?php
require_once "config.php";


if(isset($_POST['pjob'])){
   $cname=$_POST['cname'];
   $pos=$_POST['pos'];
   $jdesc=$_POST['jdesc'];
   $skills=$_POST['skills'];
   $ctc=$_POST['ctc'];

   $sql="INSERT INTO `jobs`( `cname`, `pos`, `jdesc`, `skills`, `ctc`) VALUES ('$cname','$pos','$jdesc','$skills','$ctc')";
   mysqli_query($conn,$sql);    
}

?>

<?php

if(isset($_POST['djob'])){
    $id=(int) $_POST['myid'];

    // sql to delete a record
    $sql = "DELETE FROM jobs WHERE id=".$id;

    if ($conn->query($sql) === TRUE) {
       
    } else {
        echo "Error deleting record: " . $conn->error;
    }
     
   
  }
 
?>


<style>
  body{
    background-color:#F3F7F9;
  }

  .table{
    border:2px solid black;
    text-align:center;
    padding :2px;
  }
  tr:hover {background-color: #D6EEEE;}
  .table th{
    border:2px solid black;
    text-align:center;
    padding :2px;
    
  }
  
  .table td{
    border:2px solid black;
    padding :2px;
  }
</style>

<div class="content">
<p>
  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    POST JOB
  </a>
  
</p>
<div class="collapse" id="collapseExample" >
  
  <div class="card card-body">

  <form action="" method="post" class="myform">
    <br>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Company Names</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cname">
  </div>
  <br>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Position</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="pos">
  </div>
  <br>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">JOB Description</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="jdesc">
  </div>
  <br>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Skills Required</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="skills">
  </div>
  <br>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">CTC</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ctc">
  </div>
  <br>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">confirm</label>
  </div>
  <br>
  <button type="submit" class="btn btn-primary submit" name="pjob">Submit</button>
  <br>
</form>
  </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Company Name</th>
      <th scope="col">Position</th>
      <th scope="col">CTC</th>
     
    </tr>
  </thead>
  <tbody>
     <?php  
       require_once "config.php";

      $sql="SELECT id,cname,pos,ctc FROM jobs";
    
      $result = mysqli_query($conn,$sql);
           

        if($result->num_rows>0){
            $i=0;
           while($rows=$result->fetch_assoc()){
            
            
             echo "<tr>".
                  "<td>".++$i."</td>
                   <td>".$rows['cname']."</td>
                   <td>".$rows['pos']."</td>
                   <td>".$rows['ctc']."</td>".
                   "<td><span class='deleteMember'>
                    <form action='' method='post'>
                        <input type='hidden' name='myid' value='".$rows['id']."' />
                        <button type='submit' name='djob' onClick='note()'><i class='fas fa-trash-alt' style='color:red;'></i></button>
                    </form>
                </span></td>".
                   "</tr>";
                   
           }
        }
        mysqli_free_result($result);


       
         

       
     ?>
  </tbody>
</table>
</div>

<script>

function note(){
  alert("do you want to delete this job!!");
}
  </script>


