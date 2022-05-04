<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['nm']))
{
    header("location: dashboard.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['nm'])) || empty(trim($_POST['password'])))
    {
        $err = "username or password cant be blank";
    }
    else{
        $username = trim($_POST['nm']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, name, password FROM registered WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["name"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: dashboard.php");
                            
                        }
                        else{
                          $err = "Incorrect Password";
                        }
                    }

                }
                else{
                  $err = "username not found";
                }

    }
}    


}

?>




<!doctype html>  
<html>  
      <head>  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
           <title> Login Page</title>  

      <style>
          body{
            background:url('img/loginImg.png');
            background-size:cover;
          }
          .container{
            margin-top:150px;
            
          }
          form{
            box-shadow: 5px 10px 8px 10px #888888;
            padding:15px;
            background:white;
            margin-left:50em;
            border-radius:2px;
          }
          .error{
            color:red;
          }
          </style>
      </head>  
      <body>
      <div class="container">  
      <form action="" method="post">
          
   <div class="mb-3" >
    <label for="exampleInputName" class="form-label">UserName</label>
    <input type="type" class="form-control" id="exampleInputname1" aria-describedby="emailHelp" name="nm">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <a>new user!</a>
  <a href="register.php">click here to register</a>
  <button type="submit" class="btn btn-primary">Submit</button>
  <br><span class="error" >*<?php echo $err; ?></span>
</form>
</div>  
      </body>  
</html>  