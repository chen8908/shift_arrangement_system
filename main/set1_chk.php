<?php

include("conn.php");

$dID = $_POST["dID"];
$sMonth=$_POST['sMonth'];

#echo $dID.$sMonth;

/*查詢分店人數*/
$sql_have=mysqli_query($conn,"select count(dID) as A from employee where dID='".$dID."'");
$info_have=mysqli_fetch_array($sql_have);


/*分店所需上班人力加總*/
$sql_need=mysqli_query($conn,"select D_epy_num + E_epy_num as B from d_time where dID='".$dID."'");
$info_need=mysqli_fetch_array($sql_need);

#SQL查詢shift_info
$sql_shift = mysqli_query($conn, "select * from shift_info where sMonth='".$sMonth."' and dID='".$dID."'");
$info_shift = mysqli_fetch_array($sql_shift);  

#SQL查詢 d_time
$sql_d = mysqli_query($conn, "select * from d_time where  dID='".$dID."'");
$info_d = mysqli_fetch_array($sql_d);  

#echo $info_have[0]."<br>".$info_need[0]."<br>";
if($info_shift == true){
    echo "<script>alert('該月份之部門班表已存在 !');history.back();</script>";
    exit;
}

else{
    #兩班周休二日
    if($info_d['dtype']=='t1'){
        if($info_have[0]>=$info_need[0]){
            header("Location:set2_t1.php?dID=".$dID."&sMonth=".$sMonth);
        }
        else{
            echo "<script>alert('人手不足!!請增加人力');window.location='epy.php?dID=".$dID."';</script>";
        }
    }
    #兩班輪班
    elseif($info_d['dtype']=='t2'){

        if($info_need[0]-$info_have[0] >=1){

            echo "<script>alert('人手不足!!請增加人力');window.location='epy.php?dID=".$dID."';</script>";
    
            exit;
        }
        
        else{
            
            header("Location:set2_t2.php?dID=".$dID."&sMonth=".$sMonth);
        }
    }
    #三班輪班
    elseif($info_d['dtype']=='t3'){
        

        if($info_need[0]-$info_have[0] >=1){

            echo "<script>alert('人手不足!!請增加人力');window.location='epy.php?dID=".$dID."';</script>";
    
            exit;
        }
        
        else{
            
            header("Location:set2_t3.php?dID=".$dID."&sMonth=".$sMonth);
        }
    }
    else{
        echo "<script>alert('排班類型錯誤!');history.back();</script>";
    }

    
}



?>