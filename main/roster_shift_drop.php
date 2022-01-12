<?php

include("conn.php");
/*
while(list($name,$value)=each($_POST))
{
    #echo $value."<br>";	  
    mysqli_query($conn,"delete from employee where eid='".$value."'");
    $count+=1;
}*/

$dID=$_GET['dID'];
$sMonth=$_GET['sMonth'];

$sql=mysqli_query($conn,"select * from shift_info where dID='".$dID."'and sMonth='".$sMonth."'");
$info=mysqli_fetch_array($sql);

if($info==False)
{
   echo "<script>alert('該班表資料不存在 !');history.back();</script>";
   exit;
}
else{
    $result_sf=mysqli_query($conn,"DELETE FROM shift WHERE dID='".$dID."'and sMonth='".$sMonth."'");
    $result_sf_in=mysqli_query($conn,"DELETE FROM shift_info WHERE dID='".$dID."'and sMonth='".$sMonth."'");
    $result_pay=mysqli_query($conn,"DELETE FROM pay WHERE dID='".$dID."'and sMonth='".$sMonth."'");

    if ($result_sf & $result_sf_in & $result_pay){
    echo "<script>alert('成功刪除班表!');window.location='roster.php';</script>";
	}
    else{
	    echo "<script>alert('刪除失敗 !');window.location='roster.php';</script>";  
    }
}




?>