<?php
include("conn.php");

$dID=$_GET['dID'];
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

#echo $dID.'<br>'.$dName.'<br>'.$degName.'<br>'.$dtype.'<br>'.$D1.'<br>'.$D2.'<br>'.$E1.'<br>'.$E2.'<br>'.$D_epy_num.'<br>'.$E_epy_num;

$result=mysqli_query($conn,"UPDATE department SET dName='$dName',degName='$degName' WHERE dID='".$dID."'" );
$result2=mysqli_query($conn,"UPDATE d_time SET dtype='$dtype',D1='$D1',D2='$D2',E1='$E1',E2='$E2',N1='$N1',N2='$N2',D_epy_num='$D_epy_num',E_epy_num='$E_epy_num',N_epy_num='$N_epy_num' WHERE dID='".$dID."'" );

	
if ($result & $result2)
{
    echo "<script>alert('成功修改分行資訊 !');window.location='epy_group.php';</script>";
} 
else
{
	  echo "<script>alert('修改失敗 !');window.location='epy_group.php';</script>";
	    
}

?>