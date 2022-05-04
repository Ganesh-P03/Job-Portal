
  
<?php
require_once "config.php";

$username = $password = $confirm_password =$email=$mobileNo= "";
$username_err = $password_err = $confirm_password_err =$email_err=$mobileNo_err= "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["nm"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM registered WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['nm']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['nm']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }

   


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

//check email
if(empty(trim($_POST['em']))){
  $email_err = "Email cannot be blank";
}
else{
  $email = trim($_POST['em']);
}

// Check for mobileNo
if(empty(trim($_POST['num']))){
  $mobileNo_err = "Mobile Number cannot be blank";
}
elseif(strlen(trim($_POST['num'])) != 10){
  $mobileNo_err = "Enter valid Mobile Number";
}
else{
  $mobileNo = trim($_POST['num']);
}


// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['cpassword'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($mobileNo_err))
{
    $sql = "INSERT INTO registered (name,email,mobileNo,Password) VALUES (?, ?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssss", $param_username,$param_email,$param_mobileNo, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_email = $email;
        $param_mobileNo = $mobileNo;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
else{
 
  
}
mysqli_close($conn);
}

?> 






<!doctype html>  
<html>  
      <head> 
      <meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     
      <title> registration Page</title>  

      <style>

          body{
            background-image:url("img/register.jpeg");
            background-size: cover;
          }
          .container{
            margin-top:80px;
            
            margin-bottom:80px;
          }
          form{
            
            margin-left:40em;
            box-shadow: 1px 1px 8px 10px #888888;
            padding:15px;
            background:white;
            
          }
          .error{
            color:red;
          }
          </style>
      </head>  
      <body>
      <div class="container"> 
         
      <form action='' method="post">
      <h1> Registration Form </h1> 
      <div class="mb-3" >
    <label for="exampleInputName" class="form-label">User Name</label>
    <input type="text" class="form-control" aria-describedby="emailHelp" name="nm">
    <span class="error" >*<?php echo $username_err; ?></span>
  </div>

   <div class="mb-3" >
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="em">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    <span class="error" >*<?php echo $email_err; ?></span>
  </div>

  <div class="mb-3" >
    <label for="exampleInputName" class="form-label">Mobile Number</label>
    <input type="number" class="form-control" aria-describedby="emailHelp" name="num">
    <span class="error" >*<?php echo $mobileNo_err; ?></span>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    <span class="error" >*<?php echo $password_err; ?></span>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword2" name="cpassword">
    <span class="error" >*<?php echo $confirm_password_err; ?></span>
  </div>

  <a>old user!</a>
  <a href="login.php">click here to login</a>
  <button type="submit" value="submit" class="btn btn-primary" name="submit" method="POST">Submit</button>
</form>
</div>  


      </body> 

</html>  


