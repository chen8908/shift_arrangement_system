<?php
include("conn.php");

$dID=$_GET['dID'];

$sql=mysqli_query($conn,"select * from department where dID='".$dID."'");
$info=mysqli_fetch_array($sql);

$dName=$info['dName'];


if($info==False)
{
   echo "<script>alert('該分行資料不存在 !');history.back();</script>";
   exit;
}
 else
{  
    $result_dp=mysqli_query($conn,"DELETE FROM department WHERE dID='".$dID."'");
    $result_em=mysqli_query($conn,"DELETE FROM employee WHERE dID='".$dID."'");
    $result_dt=mysqli_query($conn,"DELETE FROM d_time WHERE dID='".$dID."'");
	
if ($result_dp & $result_em)
{
    echo "<script>alert('成功刪除 ".$dID.$dName." !');window.location='epy_group.php';</script>";
	}
 else
  {
	echo "<script>alert('刪除失敗 !');window.location='epy_group.php';</script>";
	    
  }
}
?>