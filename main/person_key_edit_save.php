<?php

$eID=$_GET['eID'];
$epw=md5($_POST['epw']);

include("conn.php");

$sql=mysqli_query($conn,"select * from employee where eID='".$eID."'");
$info=mysqli_fetch_array($sql);

$sql_B=mysqli_query($conn,"select * from leader where eID='".$eID."'");
$info_B=mysqli_fetch_array($sql_B);
#echo $eID.$epw;



    
if($info==true){

    $result=mysqli_query($conn,"UPDATE employee SET epw='$epw' WHERE eID='".$eID."'" );
}
elseif($info_B==true){

    $result=mysqli_query($conn,"UPDATE leader SET epw='$epw' WHERE eID='".$eID."'" );
}
else{
    echo "<script>alert('資料錯誤!');history.back();</script>";    
}

if($result)
{
    echo "<script>alert('更新密碼成功!  若忘記密碼，請洽詢主管協助');window.location='login.php';</script>";
    
}
else
{
	echo "<script>alert('修改失敗!');history.back();</script>";    
}

?>