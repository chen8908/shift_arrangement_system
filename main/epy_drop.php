<?php

$dID=$_GET['dID'];

include("conn.php");
/*
while(list($name,$value)=each($_POST))
{
    #echo $value."<br>";	  
    mysqli_query($conn,"delete from employee where eid='".$value."'");
    $count+=1;
}*/

foreach(array_keys($_POST) as $value) {
    mysqli_query($conn,"delete from employee where eid='".$value."'");
    $count+=1;
}

if($count<= 1)
{
    echo "<script>alert('無選取任何資料');window.location='epy.php?dID=".$dID."';</script>";
    exit;
}
echo "<script>alert('成功刪除 !');window.location='epy.php?dID=".$dID."';</script>";


?>