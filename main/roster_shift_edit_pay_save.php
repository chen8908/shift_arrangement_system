<?php
include('conn.php');

$sMonth=$_GET['sMonth'];
$dID=$_GET['dID'];

#echo $sMonth.$dID;

$sql = mysqli_query($conn, "SELECT eName,COUNT(*) as cou from shift WHERE sMonth='$sMonth' and dID='$dID' GROUP BY eName");
$info = mysqli_fetch_array($sql);

do{
    $eName = $info['eName'];

    #月份班表上班天數
    $sql_day = mysqli_query($conn, "SELECT eName,COUNT(*) as sum_day from shift where sMonth='".$sMonth."' and dID='".$dID."' and eName='$eName' and time!='B' GROUP BY eName;");
    $info_day = mysqli_fetch_array($sql_day);

    #月份班表上班時數
    $sql_hour = mysqli_query($conn, "SELECT eName,SUM(work_hours) as sum_hour FROM shift WHERE sMonth='$sMonth' and dID='$dID' and eName='$eName'");
    $info_hour = mysqli_fetch_array($sql_hour);

    #查詢員工資訊
    $sql_epy = mysqli_query($conn, "SELECT * FROM employee WHERE  dID='$dID' and eName='$eName'");
    $info_epy = mysqli_fetch_array($sql_epy);

    if($info_epy['etype'] == 'ft'){
      $money=$info_epy['mon_rate'];
    }
    elseif($info_epy['etype'] == 'pt'){
      $money=$info_epy['hor_rate'] * $info_hour['sum_hour'];
    }
    else{
      $mony=0;
    }

    #$result=mysqli_query($conn,"insert into pay (sMonth,dID,eName,sum_day,sum_hour,money) values ('$sMonth','$dID','$eName','$info_day[sum_day]','$info_hour[sum_hour]','$money')");
    $result=mysqli_query($conn,"UPDATE pay SET `sum_day`='$info_day[sum_day]',`sum_hour`='$info_hour[sum_hour]',`money`='$money' WHERE sMonth='".$sMonth."' and  eName='".$eName."'");

}while($info = mysqli_fetch_array($sql));


if ($result){
  echo "<script>alert('成功修改".$sMonth."月班表');window.location='roster_shift.php?dID=".$dID."&sMonth=".$sMonth."'   ;</script>";
}
else{
    echo "<script>alert('失敗')</script>";
}

?>