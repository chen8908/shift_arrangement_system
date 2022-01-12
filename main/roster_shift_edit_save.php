<?php

#include('set2.php');
include('conn.php');

$dID=$_GET['dID'];
$saDays=$_GET['saDays'];
$sMonth=$_GET['sMonth'];
$remark=$_POST['remark'];
#echo $dID.$saDays;

/*查詢分店上班時數*/
$sql_d = mysqli_query($conn, "select * from d_time where dID='" . $dID . "'");
$info_d = mysqli_fetch_array($sql_d);

$D1=$info_d['D1'];
$D2=$info_d['D2'];
$E1=$info_d['E1'];
$E2=$info_d['E2'];
$N1=$info_d['N1'];
$N2=$info_d['N2'];

if($D1 > $D2){
  @$D2+=24;
}
if($E1 > $E2){
  @$E2+=24;
}
if($N1 > $N2){
  @$N2+=24;
}

@$work_hours_D=$D2-$D1;
@$work_hours_E=$E2-$E1;
@$work_hours_N=$N2-$N1;


/*查詢分店人數*/
$sql = mysqli_query($conn, "select * from employee where dID='" . $dID . "'");
$info = mysqli_fetch_array($sql);

/*查詢班表*/
$sql_sf = mysqli_query($conn, "SELECT eName,COUNT(*) as cou from shift where sMonth='$sMonth' and dID='$dID' GROUP BY eName");
$info_sf = mysqli_fetch_array($sql_sf);

$i=1;
do{
  
    #echo $eID;
    $eName=$info_sf['eName'];
  do{
    
  $sDate=$i;
  $test=$eName.'_'.$i;

  $time=$_POST[$test];
  
  if($time == 'D'){
    $result1=mysqli_query($conn,"UPDATE shift SET `time`='$time',`work_hours`='$work_hours_D' WHERE sMonth='".$sMonth."' and sDate='".$sDate."' and eName='".$eName."'");
  }
  elseif($time == 'E'){
    $result1=mysqli_query($conn,"UPDATE shift SET `time`='$time',`work_hours`='$work_hours_E' WHERE sMonth='".$sMonth."' and sDate='".$sDate."' and eName='".$eName."'");
  }
  elseif($time == 'N'){
    $result1=mysqli_query($conn,"UPDATE shift SET `time`='$time',`work_hours`='$work_hours_N' WHERE sMonth='".$sMonth."' and sDate='".$sDate."' and eName='".$eName."'");
  }
  else{
    $result1=mysqli_query($conn,"UPDATE shift SET `time`='$time',`work_hours`='0' WHERE sMonth='".$sMonth."' and sDate='".$sDate."' and eName='".$eName."'");
  }

  $i+=1;
    }while($i <= $saDays);
    $i=1;
} while ($info_sf = mysqli_fetch_array($sql_sf));

$result2=mysqli_query($conn,"UPDATE shift_info SET `remark`='$remark' WHERE sMonth='".$sMonth."' and dID='".$dID."'");

if ($result1 && $result2){
  echo "<script>window.location='roster_shift_edit_pay_save.php?sMonth=".$sMonth."&dID=".$dID."';</script>";
}
else{
echo "<script>alert('修改失敗 !');history.back();</script>";
    
}


?>