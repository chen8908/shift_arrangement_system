<?php

$eID=$_GET['eID'];
$eName=$_POST['eName'];
$ephone=$_POST['ephone'];

#echo $eID."<br>".$eName."<br>".$ephone."<br>".$privilege."<br>";

include("conn.php");
include("roster_left.php");

$privilege = $privilege_left;

if($privilege == "B"){
    $sql = mysqli_query($conn,"select * from leader where eID='" . $eID . "'");
    $info = mysqli_fetch_array($sql);

    $result=mysqli_query($conn,"UPDATE leader SET eName='$eName',ephone='$ephone' WHERE eID='".$eID."'" );
}
else{
    $sql = mysqli_query($conn,"select * from employee where eID='" . $eID . "'");
    $info = mysqli_fetch_array($sql);

    $result=mysqli_query($conn,"UPDATE employee SET eName='$eName',ephone='$ephone' WHERE eID='".$eID."'" );
}


if($result)
{
    echo "<script>alert('成功修改員工資訊 !');window.location='roster.php';</script>";
    
}
else
{
	echo "<script>alert('修改失敗 !');history.back();</script>";
}

?>