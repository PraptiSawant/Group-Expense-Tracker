<?php
include('dbconn.php');
session_start();
$query="SELECT `Group_Name` From `group_table`,`belongs_to` where `UID`='{$_SESSION['uid']}' AND `GID`= `Group_ID`";
$result=mysqli_query($conn,$query);
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
                <form action="deletegroup.php" method="post">
                    <p>Group/Event Title</p>
                    <div class="name">
                    <select name="Gname">
                    <?php while($data=mysqli_fetch_assoc($result))
                    {
                    ?>
                        <option value="<?php echo $data["Group_Name"] ?> "><?php echo $data["Group_Name"]; ?></option>
                        <?php } ?>
                        </select> 
                        </div>  
                    <input type="Submit" name="delete" value="DELETE GROUP">
                </form>
        </div>
</div>
</body>
</html>
<?php
    
    if(isset($_POST['delete']))
    {
        $Gn=$_POST['Gname'];
        $qy="DELETE FROM `group_table` WHERE `Group_Name`='$Gn'";
        $exe=mysqli_query($conn,$qy);
        header('location:home.php');
    }
?>