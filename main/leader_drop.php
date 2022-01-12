<?php

include("conn.php");
/*
while(list($name,$value)=each($_POST))
{
    #echo $value."<br>";	  
    mysqli_query($conn,"delete from employee where eid='".$value."'");
    $count+=1;
}*/

foreach(array_keys($_POST) as $value) {
    mysqli_query($conn,"delete from leader where eid='".$value."'");
    echo $value."<br>";
    $count+=1;
}

if($count<= 1)
{
    echo "<script>alert('無選取任何資料');window.location='leader.php';</script>";
    exit;
}
echo "<script>alert('成功刪除 !');window.location='leader.php';</script>";


?>