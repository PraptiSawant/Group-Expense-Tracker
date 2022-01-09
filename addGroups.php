<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Group Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="AddGrp">
                <form action="addGroups.php" method="post" enctype="multipart/form-data">
                    <p>Group/Event Title</p>
                    <input type="text" name="Gname" >
                    <p>Total Number Of members</p>
                    <input type="number" name="nm">
                    <p>Image</p>
                    <input type="file" name="img">
                    <input type="Submit" name="create" value="CREATE GROUP">
                </form>
        </div>
</div>
</body>
</html>
<?php
    include('dbconn.php');
    if(isset($_POST['create']))
    {
       $Gn=$_POST['Gname'];
       $no=$_POST['nm'];

       $image_name= $_FILES['img']['name'];
       $image_type= $_FILES['img']['type'];
       $image_size= $_FILES['img']['size'];
       $image_tmp_name= $_FILES['img']['tmp_name'];

       move_uploaded_file($image_tmp_name,"photos/$image_name");
     

       $qry="INSERT INTO `group_table`(`Group_Name`,`Grp_image`) VALUES ('$Gn','photos/$image_name')";
       $result=mysqli_query($conn,$qry);

       $query="SELECT `Group_ID` FROM `group_table` WHERE `Group_Name`= '$Gn'";
       $result=mysqli_query($conn,$query);
       $data=mysqli_fetch_assoc($result);

       $gid=$data['Group_ID'];
       $_SESSION['gid']=$gid;
       $_SESSION['nm']=$no;
       $qry="INSERT INTO `belongs_to`(`UID`, `GID`) VALUES ('{$_SESSION['uid']}','{$_SESSION['gid']}')";
       $result=mysqli_query($conn,$qry);
       header('location:addmembers.php');
    }
?>