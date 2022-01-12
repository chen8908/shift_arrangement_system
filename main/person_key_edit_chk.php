<?php

$eID=$_GET['eID'];
$epw=md5($_POST['epw']);
#echo $eID.$epw;

include("conn.php");

$sql=mysqli_query($conn,"select * from Employee where eID='".$eID."'and epw='".$epw."'");

$info=mysqli_fetch_array($sql);

$sql_B=mysqli_query($conn,"select * from leader where eID='".$eID."'and epw='".$epw."'");

$info_B=mysqli_fetch_array($sql_B);


if($info==true or $info_B==true)
{

    header("Location:person_key_edit2.php?eID=$eID");
}

else
{
    
    echo "<script>alert('密碼錯誤!');history.back();</script>";
    exit;
}


?>