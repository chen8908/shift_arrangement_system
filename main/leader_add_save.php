<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php

include("conn.php");
//取得使用者輸入(註冊)資料，以下根據各組選的系統資料表欄位有所不同

$eID=$_POST['eID'];
$epw=md5($eID);
$eName=$_POST['eName'];
$ephone=$_POST['ephone'];
$privilege=$_POST['privilege'];

#echo $eID.'<br>'.$epw.'<br>'.$eName.'<br>'.$ephone.'<br>'.$privilege;


//以下一行是檢查帳號是否存在。各組選的系統資料表有所不同
$sql=mysqli_query($conn,"select * from leader where eID='".$eID."'");
$info=mysqli_fetch_array($sql);

    
if($info==true){
   echo "<script>alert('該員工帳號已存在 !');history.back();</script>";
   exit;
}
else{  
    //以下一行是執行新增註冊資料。各組選的系統資料表欄位有所不同
	#$result=mysqli_query($conn,"INSERT INTO learder(dID,eID,epw,eName,ephone,etype,hor_rate,mon_rate,privilege) values ('$eID','$epw','$eName','$ephone','$etype','$hor_rate','$mon_rate','$privilege')");
  
  $result1=mysqli_query($conn,"insert into leader (eID,epw,eName,ephone,privilege) values ('$eID','$epw','$eName','$ephone','$privilege')");
	
  if ($result1){
    echo "<script>alert('成功新增 ".$eName."主管!');window.location='leader.php';</script>";
  }
  else{
	#echo "<script>alert('新增失敗 !');window.location='leader.php';</script>";
	echo "error";
  }
}
?>
