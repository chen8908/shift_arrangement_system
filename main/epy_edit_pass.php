<?php
$eID=$_GET['eID'];

$new_epw=md5($eID);

#echo $eID."<br>".$new_epw;

include("conn.php");

    
$sql=mysqli_query($conn,"select * from employee where eID='".$eID."'");
$info=mysqli_fetch_array($sql);



$result=mysqli_query($conn,"UPDATE employee SET epw='$new_epw' WHERE eID='".$eID."'" );
   
if ($result)
{
    echo "<script>alert('成功設為預設!  提示:預設密碼與員工編號相同');window.location='epy.php?dID=".$info['dID']."';</script>";
}
else
{
    echo "<script>alert('密碼變更失敗!');window.location='epy.php?dID=".$info['dID']."';</script>";   
}





?>