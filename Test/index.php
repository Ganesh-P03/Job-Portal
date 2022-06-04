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