<?php

#include('set2.php');
include('conn.php');



$dID=$_GET['dID'];
$saDays=$_GET['saDays'];
$sMonth=$_GET['sMonth'];
$remark=$_POST['remark'];
#echo $dID.$saDays;

$set_date=date('Y/m/d');

/*查詢分店人數*/
$sql = mysqli_query($conn, "select * from employee where dID='" . $dID . "'");
$info = mysqli_fetch_array($sql);


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


$i=1;
do{
  
    #echo $eID;
    $eName=$info['eName'];
  do{
    
  $sDate=$i;
  $test=$info['eID'].'_'.$i;

  $time=$_POST[$test];
  #echo $info['eID'].'_'.$i;
  
  #echo $eID.'<br>'.$sDate.$time.'<br>';
  
  if($time == 'D'){
    $result1=mysqli_query($conn,"insert into shift (sMonth,sDate,dID,eName,time,work_hours) values ('$sMonth','$sDate','$dID','$eName','$time','$work_hours_D')");
  }
  elseif($time == 'E'){
    $result1=mysqli_query($conn,"insert into shift (sMonth,sDate,dID,eName,time,work_hours) values ('$sMonth','$sDate','$dID','$eName','$time','$work_hours_E')");
  }
  elseif($time == 'N'){
    $result1=mysqli_query($conn,"insert into shift (sMonth,sDate,dID,eName,time,work_hours) values ('$sMonth','$sDate','$dID','$eName','$time','$work_hours_N')");
  }
  else{
    $result1=mysqli_query($conn,"insert into shift (sMonth,sDate,dID,eName,time,work_hours) values ('$sMonth','$sDate','$dID','$eName','$time','0')");
  }


  $i+=1;
    }while($i <= $saDays);
    $i=1;
} while ($info = mysqli_fetch_array($sql));

$result=mysqli_query($conn,"insert into shift_info (sMonth,dID,set_date,remark) values ('$sMonth','$dID','$set_date','$remark')");

if ($result1 && $result){
  echo "<script>window.location='set4.php?sMonth=".$sMonth."&dID=".$dID."';</script>";
}
else{
echo "<script>alert('新增失敗 !');history.back();</script>";
    
}


?>