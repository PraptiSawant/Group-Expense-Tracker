<?php
include('dbconn.php');
session_start();
$qy="SELECT SUM(Amount) FROM `expense_tb` WHERE `Grp_ID`='{$_SESSION['grpid']}'";
$exe=mysqli_query($conn,$qy);
$dat=mysqli_fetch_assoc($exe);

$q="SELECT COUNT(*) FROM `belongs_to` WHERE `GID`='{$_SESSION['grpid']}'";
$res=mysqli_query($conn,$q);
$d=mysqli_fetch_assoc($res);

$query="SELECT `Fname`,`Lname` FROM `user`,`belongs_to` WHERE `User_ID`=`UID` AND `GID`='{$_SESSION['grpid']}' ORDER BY Joining_Date";
$result=mysqli_query($conn,$query);

$quer="SELECT `Fname`,`Lname` FROM `user`,`belongs_to` WHERE `User_ID`=`UID` AND `GID`='{$_SESSION['grpid']}' ORDER BY Joining_Date";
$resul=mysqli_query($conn,$quer);

$eph=$dat['SUM(Amount)']/$d['COUNT(*)'];
$zero=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Report Page</title>
    <link rel="stylesheet" href="stylei.css">
</head>
<body>
<header>
        <p>SHARE <img class="logo" src="photos/coin.png" alt="logo">XPENSES</p>
        <div class="bu">
        <a class="cta" href="home.php"><button>Back</button></a>
</div>
</header>
<div class="grp">
    <h4  style="color:black;">Number Of Members : <?php echo $d['COUNT(*)'];?> </h4> 
    <h4  style="color:black;">Total Expense : <?php echo $dat['SUM(Amount)']; ?> Rs</h4> 
    <h4  style="color:black;">Expense Per Head : <?php echo $eph; ?> Rs</h4> 
</div>
<div class="tb">
<br><br><br><br><br><br><br><p align="left"><font size="6">Expense Summmary</font></p>
<table class="table" border="1" width="95%" height="100%" align="center">
        <?php
             while($data=mysqli_fetch_assoc($result))
             {
        ?>
         <tr>
            <td><?php echo $data['Fname']." ".$data['Lname']?><br>Charged : <?php echo number_format($eph,2);?> , Paid : 
            <?php 
            $que=" SELECT SUM(Amount) FROM `expense_tb`,`user` WHERE `User_ID`=`UID` AND `Fname`='{$data['Fname']}' AND `Lname`='{$data['Lname']}'";
             $r=mysqli_query($conn,$que);
             $d=mysqli_fetch_assoc($r);
             if($d['SUM(Amount)']>0)
             {
             echo number_format($d['SUM(Amount)'],2);
             }
             else
             echo number_format($zero,2);
             ?></td>
             <td>
                 <?php 
                    $x=$d['SUM(Amount)']-$eph;
                    if($x>0)
                    echo "+".$x;
                    else
                    {
                    echo $x;
                    $fn=$data['Fname'];
                    }
                ?>
            </td>
        </tr>
        <?php
             }

?>

</table>
            </div>
<div class="tb">
    <p><font size="6">Settlement</font></p>
    <table class="table" border="1" width="95%" height="100%" align="center">
    <?php
             while($data=mysqli_fetch_assoc($resul))
             {
    ?>
            <?php
            $que=" SELECT SUM(Amount) FROM `expense_tb`,`user` WHERE `User_ID`=`UID` AND `Fname`='{$data['Fname']}' AND `Lname`='{$data['Lname']}'";
            $r=mysqli_query($conn,$que);
            $d=mysqli_fetch_assoc($r);
            $x=$d['SUM(Amount)']-$eph;
                    $arr["{$data['Fname']}"]=$x;   
             }
             asort($arr);
             $c=count($arr);
             $keys=array_keys($arr);
             $i=0;
             $j=$c-1;
             $debt;
             while($i<$j)
             {
                 $debt=min((-$arr[$keys[$i]]),$arr[$keys[$j]]);
                 $arr[$keys[$i]]=$arr[$keys[$i]]+$debt;
                 $arr[$keys[$j]]=$arr[$keys[$j]]-$debt;
                 ?>
                 <tr><td><?php echo $keys[$i]."<br>"." should pay to ".$keys[$j];
                 echo "<br>";?><hr></td><td><?php echo number_format($debt,2)."  Rs";?><br><br><hr></td></tr><?php
                 if($arr[$keys[$i]]==0)
                 {
                     $i++;
                 }
                 if($arr[$keys[$j]]==0)
                 {
                     $j--;
                 }

             }
            ?>
    
    </table>
            </div>
</body>
</html>