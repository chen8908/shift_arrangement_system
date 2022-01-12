<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php

	
include("conn.php");
//取得使用者輸入(註冊)資料，以下根據各組選的系統資料表欄位有所不同
$dID=$_POST['dID'];
$dName=$_POST['dName'];
$degName=$_POST['degName'];
$dtype=$_POST['dtype'];
$D1=$_POST['D1'];
$D2=$_POST['D2'];
$E1=$_POST['E1'];
$E2=$_POST['E2'];
$N1=$_POST['N1'];
$N2=$_POST['N2'];
$D_epy_num=$_POST['D_epy_num'];
$E_epy_num=$_POST['E_epy_num'];
$N_epy_num=$_POST['N_epy_num'];



//以下一行是檢查帳號是否存在。各組選的系統資料表有所不同
$sql_ID=mysqli_query($conn,"select * from department where dID='".$dID."'");
$info_ID=mysqli_fetch_array($sql_ID);

    
$sql_Name=mysqli_query($conn,"select * from department where dName='".$dName."'");
$info_Name=mysqli_fetch_array($sql_Name);


$sql_egName=mysqli_query($conn,"select * from department where degName='".$degName."'");
$info_egName=mysqli_fetch_array($sql_egName);


if($info_ID==true)
{
   echo "<script>alert('該分行編碼已存在 !');history.back();</script>";
   exit;
}
 
elseif($info_Name==true)
{
    echo "<script>alert('該分行名稱已存在 !');history.back();</script>";
    exit;
}
elseif($info_egName==true)
{
    echo "<script>alert('該分行英文簡稱已存在 !');history.back();</script>";
    exit;
}
 else
{  
    //以下一行是執行新增註冊資料。各組選的系統資料表欄位有所不同
	$result1=mysqli_query($conn,"insert into department (dID,dName,degName) values ('$dID','$dName','$degName')");
    $result2=mysqli_query($conn,"insert into d_time (dID,dtype,D1,D2,E1,E2,N1,N2,D_epy_num,E_epy_num,N_epy_num) values ('$dID','$dtype','$D1','$D2','$E1','$E2','$N1','$N2','$D_epy_num','$E_epy_num','$N_epy_num')");
    
	
if ($result1 && $result2)
{
	
 
    echo "<script>alert('成功新增分行 !');window.location='epy_group.php';</script>";
	}
 else
  {
	echo "<script>alert('新增失敗 !');</script>";
	    
  }
}
?>
