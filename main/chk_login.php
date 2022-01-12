
<?php

include("conn.php");

$eID=$_POST['eID'];
$epw=md5($_POST['epw']);


/*一般職員 & 中階主管 */
$sql=mysqli_query($conn,"select * from Employee where eID='".$eID."'and epw='".$epw."'");
$info=mysqli_fetch_array($sql);

/*高階主管 */
$sql_B=mysqli_query($conn,"select * from leader where eID='".$eID."'and epw='".$epw."'");
$info_B=mysqli_fetch_array($sql_B);


if($info==true | $info_B==true)
{

    setcookie("lgid",$eID,time()+3600*24);//3600為一小時
    setcookie("lgpwd",$epw,time()+3600*24);//*24為一天
    sleep(2);
    header("Location:roster.php");
}

else
{
    echo "<script>alert('帳號或密碼錯誤!');history.back();</script>";
    exit;
}

?>