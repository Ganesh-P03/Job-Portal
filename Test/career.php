<?php
require_once "config.php";

if(isset($_POST['apply'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  
  $mobileNo = trim($_POST['mobileNo']);
  $appliedFor=$_COOKIE["appliedFor"];
  $place=$_POST['place'];

  $sql="INSERT INTO `candidates`( `name`, `email`, `mobileNo`, `place`,`applyingFor`) VALUES ('$name','$email','$mobileNo','$place','$appliedFor')";
  mysqli_query($conn,$sql);    
}

?>
<!doctype html>  
<html>  
      <head> 
      <meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<link rel= "stylesheet" type= "text/css" href= "style\careerStyle.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    
          <title>carrer</title>  

      </head>  
      <body>

        
       

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>JOB PORTAL</h1>
    <p>Find your best job.....</p>
    
  </div>
  <div><h2> </h2></div>
</div>

<div class="content">
<?php
$sql="SELECT id,cname,jdesc,pos,skills,ctc FROM jobs";
$result = mysqli_query($conn,$sql);  
if($result->num_rows>0){
  $i=0;
  while($rows=$result->fetch_assoc()){
   
     if(++$i%3==1){?>
    
    <div class="cards-container" >
<?php }?>
<div class="card"  >
  <div class="card-body" >
    <h1 class="card-title"><?php echo $rows['cname'] ?></h1>
    <br>
    <p class="card-text">Job Description : <?php echo $rows['jdesc'] ?></p>
    <br>
    <span>Position : <?php echo $rows['pos'] ?></span>
    <br><br>
    <span>Skills Required : <?php echo $rows['skills'] ?></span>
    <br><br>
    <span>CTC : <b><?php echo $rows['ctc'] ?></b></span>
    <br><br>
    <button class="open-button" onclick="openForm()">Open Form</button>
    
  </div>
</div>

<?php
if($i%3==0){?>
</div>
<?php } ?>
          
<?php }}?>



<!-- form -->
 <div class="form-popup" id="myForm">
  <form action="" class="form-container" method="post" >
    <h1>Job Application Form</h1>

    <label for="psw"><b>Name</b></label>
    <input type="text" placeholder="full name" name="name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    
    <label for="disabledTextInput" class="form-label">Applying For</label>
    <input type="text" id="disabledTextInput" class="form-control" name="applyingFor"  disabled>
    

    
    <label for="psw"><b>Mobile Number</b></label>
    <input type="text" placeholder="MobileNumber" name="mobileNo" required>

    


    <label for="psw"><b>Place</b></label>
    <input type="text" placeholder="Place" name="place" required>

    <button type="submit" class="btn" onClick="alert('succesfully applied')" name="apply">Apply</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>


</div>



<script>
var str;
for(var i=0;i<document.querySelectorAll(".open-button").length;i++){
 
  document.querySelectorAll(" .open-button")[i].addEventListener("click",function(status){
 
     this.parentElement.parentElement.style.backgroundColor="#FFFAF0";
     var temp=this.parentElement.parentElement;
     temp.setAttribute("id", "disCard");;
     document.querySelector(".content").classList.add("dis");
     console.log(temp.classList);
     for(var j=0;j<document.querySelectorAll(".open-button").length;j++){
       
           if(temp==document.querySelectorAll(".open-button")[j].parentElement.parentElement){ console.log("hello"); continue;}
           else{
              
             document.querySelectorAll(".open-button")[j].parentElement.parentElement.classList.add("blurEffect");
             console.log(this.parentElement.parentElement.classList);
           }
     }


     var arr= document.querySelectorAll("#disCard span");
     
      str=arr[0].innerHTML+" in "+document.querySelector("#disCard h1").innerHTML+" company";
    

    document.querySelector("#disabledTextInput").setAttribute("placeholder", str);

      
    $(document).ready(function () {
    createCookie("appliedFor", str, "10");
    });

   

     
  });
 
}

function createCookie(name, value, days) {
    var expires;
   if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
   }
   else {
    expires = "";
   }
   document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
 }


</script>






<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {

  document.getElementById("myForm").style.display = "none";
  document.querySelector(".content").classList.remove("dis");


  for(var i=0;i<document.querySelectorAll(".open-button").length;i++){

   var active=document.querySelectorAll(" .open-button")[i];
 
     active.parentElement.parentElement.style.backgroundColor="white";
             
     active.parentElement.parentElement.classList.remove("blurEffect");
         
       
     
     
  }

  document.querySelector("#disCard").removeAttribute('id');
  

  
}

</script>

<script>
 
  function time(){
    
    document.querySelector("h2").innerHTML= new Date().toLocaleTimeString();
  }
  setInterval(time, 1000);
   
</script>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

      </body>  
</html>    
