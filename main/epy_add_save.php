<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php

include("conn.php");
//取得使用者輸入(註冊)資料，以下根據各組選的系統資料表欄位有所不同
$dID=$_GET['dID'];
$eID=$_POST['eID'];
$epw=md5($eID);
$eName=$_POST['eName'];
$ephone=$_POST['ephone'];
$etype=$_POST['etype'];
$mon_rate=$_POST['mon_rate'];
$hor_rate=$_POST['hor_rate'];
$privilege=$_POST['privilege'];

#echo $dID.'<br>'.$eID.'<br>'.$epw.'<br>'.$eName.'<br>'.$ephone.'<br>'.$etype.'<br>'.$mon_rate.'<br>'.$hor_rate.'<br>'.$privilege;


//以下一行是檢查帳號是否存在。各組選的系統資料表有所不同
$sql=mysqli_query($conn,"select * from employee where eID='".$eID."'");
$info=mysqli_fetch_array($sql);

    
if($info==true)
 {
   echo "<script>alert('該員工帳號已存在 !');history.back();</script>";
   exit;
 }
 else
 {  
    //以下一行是執行新增註冊資料。各組選的系統資料表欄位有所不同
	#$result=mysqli_query($conn,"INSERT INTO employee(dID,eID,epw,eName,ephone,etype,hor_rate,mon_rate,privilege) values ('$dID','$eID','$epw','$eName','$ephone','$etype','$hor_rate','$mon_rate','$privilege')");
  
  $result1=mysqli_query($conn,"insert into employee (dID,eID,epw,eName,ephone,etype,hor_rate,mon_rate,privilege) values ('$dID','$eID','$epw','$eName','$ephone','$etype','$hor_rate','$mon_rate','$privilege')");
	
if ($result1)
{
    echo "<script>alert('成功新增員工 ".$eName."!');window.location='epy.php?dID=".$dID."';</script>";
  }
else
  {
	echo "<script>alert('新增失敗 !');window.location='epy.php?dID=".$dID."';</script>";
	    
  }
}
?>
