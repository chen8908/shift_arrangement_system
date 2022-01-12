<?php
          $dbuser="root"; //資料庫使用者帳號
		  $dbpass="";    //密碼
		  $dbname="roster";//欲聯結的資料庫名稱
		  		  
		  $conn=mysqli_connect("localhost",$dbuser,$dbpass) or die("伺服器連接錯誤".mysqli_error($conn));
		  mysqli_select_db($conn,$dbname) or die("資料庫連結失敗".mysqli_error($conn));
          $conn->set_charset("utf8");
          

/*
//測試連線
header("Content-Type:text/html;charset=utf-8");

$_hostname="localhost";
$_admin="admin";
$_passwd="admin";


$link=mysqli_connect($_hostname,"admin","admin") or die("資料庫連線失敗！！");
*/
/* 
//未來連接自己的資料庫
$cuid=@$_POST["cuid"];
$cupwd=@$_POST["cupwd"];


if(isset($_POST["cuid"]) && isset($_POST["cupwd"])){

    setcookie("lgid","",time()-999999999999);
    setcookie("lgpwd","",time()-999999999999);
    
    $cuid=@$_POST["cuid"];
    $cupwd=@$_POST["cupwd"];

if((!isset($_COOKIE["lgid"])) || (!isset($_COOKIE["lgpwd"]))){

    setcookie("lgid",$cuid,time()+3600*24);//3600為一小時
    setcookie("lgpwd",$cupwd,time()+3600*24);//*24為一天
    header("Location:conn.php");
}
}

echo $_COOKIE["lgid"];
echo "<br>";
echo $_COOKIE["lgpwd"];

$_hostname="localhost";

$conn=mysqli_connect($_hostname,$_COOKIE["lgid"],$_COOKIE["lgpwd"])or die("登入失敗!");
*/
/*
if(!$link)
{
    echo "Error:your id or password is not corrent.";
}
else
{
    header("Location:roster.php");
}
*/

?>