<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left">
        <div class="slogan1">  
        <p style="color:#ffffff;">SHARE EXPENSES</p>
</div>
        <div class="slogan2">
        <p align="center" ><font size="6">Hello Welcome!</font></p>
        <p align="center" ><font size="4">Enter Your personal details<br>and start a journey with us</font></p>
        </div>
        </div>
        <div class="right">
            <div class="formbx">
                <form action="signup.php" method="GET">
                    <h4>SIGNUP</h4>
                    <p>First Name</p>
                    <input type="text" name="fname">
                    <p>Last Name</p>
                    <input type="text" name="lname" >
                    <p>Email-ID</p>
                    <input type="text" name="Eid" >
                    <p>Password</p>
                    <input type="password" name="pass" >
                    <input type="Submit" name="signup" value="Register">
                    <p>Already a member ? </p>
                    <input type="Submit" name="login" value="Log In">
                </form>
            </div>
        </div>
</body>
</html>
<?php
   
   include('dbconn.php');
   if(isset($_GET['signup']))
   {
       $fn=$_GET['fname'];
       $ln=$_GET['lname'];
       $email=$_GET['Eid'];
       $password=$_GET['pass'];
       $qry="INSERT INTO `user`(`Fname`, `Lname`, `Email_ID`, `Password`) VALUES ('$fn','$ln','$email','$password')";
       $result=mysqli_query($conn,$qry);
       header('location:login.php');
   }
   if(isset($_GET['login']))
   {
        header('location:login.php');
   }

?>