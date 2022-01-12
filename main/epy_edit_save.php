<?php

$eID=$_GET['eID'];
$eName=$_POST['eName'];
$ephone=$_POST['ephone'];
$etype=$_POST['etype'];
$mon_rate=$_POST['mon_rate'];
$hor_rate=$_POST['hor_rate'];
$privilege=$_POST['privilege'];
 
#echo $eID."<br>".$eName."<br>".$ephone."<br>".$etype."<br>".$mon_rate."<br>".$hor_rate."<br>".$privilege."<br>";

	
include("conn.php");

$sql=mysqli_query($conn,"select * from employee where eID='".$eID."'");
$info=mysqli_fetch_array($sql);



$result=mysqli_query($conn,"UPDATE employee SET eName='$eName',ephone='$ephone',etype='$etype',mon_rate='$mon_rate',hor_rate='$hor_rate',privilege='$privilege' WHERE eID='".$eID."'" );
    


if($result)
{
    echo "<script>alert('成功修改員工資訊 !');window.location='epy.php?dID=".$info['dID']."';</script>";
    
}
else
{
	echo "<script>alert('修改失敗 !');window.location='epy.php?dID=".$info['dID']."';</script>";    
}

?>