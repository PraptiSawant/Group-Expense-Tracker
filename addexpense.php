<?php 
include('dbconn.php');
session_start();
       $qry="SELECT * FROM `category` ORDER BY `Category_Name` ASC";
       $result=mysqli_query($conn,$qry);
       $row=mysqli_num_rows($result);
       $query="SELECT * FROM `belongs_to`,`user` WHERE `User_ID`=`UID` AND `GID`='{$_SESSION['grpid']}'";
       $res=mysqli_query($conn,$query);
       $r=mysqli_num_rows($res);
?>
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
        <div class="AddExp">
    
                <form action="addexpense.php" method="post">
                    <p>Payee First Name</p>
                    <div class="name">
                    <select name="PFname">
                    <?php for($i=0;$i<$r;$i++)
                        {
                            $data=mysqli_fetch_assoc($res);
                    ?>
                        <option value="<?php echo $data["Fname"] ?> "><?php echo $data["Fname"]." ".$data["Lname"]; ?></option>
                        <?php } ?>
                        </select> 
                        </div>  
                        <p>Amount(Rs)</p>
                        <input type="number" step="0.01" name="amt" >
                        <p>Category</p>
                        <div class="category">
                        <select name="category">
                        <?php 
                        for($i=0;$i<$row;$i++)
                        {
                            $data=mysqli_fetch_assoc($result);
                        ?>
                        <option value="<?php echo $data["Category_Name"] ?> "><?php echo $data["Category_Name"]; ?></option>
                        <?php } ?>
                        </select>
                        </div>
                        <input type="Submit" name="exit" value="EXIT"></input>
                    <input type="Submit" name="addexpense" value="ADD EXPENSES"></input>
                </form>
        </div>
     </div>
</body>
</html>
<?php
include('dbconn.php');
     if(isset($_POST['addexpense']))
     {
        $pf=$_POST['PFname'];
        $amt=$_POST['amt'];
        $cat=$_POST['category'];
        $qy="SELECT `Category_ID` FROM `category` WHERE `Category_Name`='$cat'";
        $exe=mysqli_query($conn,$qy);
        $dat=mysqli_fetch_assoc($exe);
        $cat=$dat['Category_ID'];
        ?>
        <?php
        $q="SELECT `User_ID` FROM `user` WHERE `Fname`='$pf'";
        $execute=mysqli_query($conn,$q);
        $user_id=mysqli_fetch_assoc($execute);
        $uid=$user_id['User_ID'];
        $qry="INSERT INTO `expense_tb`(`UID`, `Amount`, `Grp_ID`, `Cat_ID`) VALUES ('$uid','$amt','{$_SESSION['grpid']}','$cat')";
        $result=mysqli_query($conn,$qry);
     }

     if(isset($_POST['exit']))
     {
         header('location:details.php');
     }
?>

