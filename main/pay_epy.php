<?php

$dID=$_GET['dID'];
$sMonth=$_GET['sMonth'];
$eName=$_GET['eName'];

#echo $dID.$sMonth.$eName;
?>
<head>

<script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
<link href="../css/table.css" rel="stylesheet">
<script type="text/javascript" src="../js/table.js"></script>
<link rel="stylesheet" href="../css/breadcrumb.css">
<link rel="stylesheet" href="../css/main2.css">

</head>

<?php
include("conn.php");
include("roster_left.php");

#SQL 搜尋薪資
$sql = mysqli_query($conn,"select * from pay where dID='" . $dID . "' and sMonth='".$sMonth."' and eName='".$eName."'");
$info = mysqli_fetch_array($sql); 

#SQL查詢department
$sql_dp=mysqli_query($conn,"select * from department where dID='$dID'");
$info_dp=mysqli_fetch_array($sql_dp);

?>
<!--Title-->
<title>SA排班-<?php echo $eName.'_'.$sMonth.'月'?>薪資紀錄</title>


<div class="content">

  <!--麵包屑-->
  <div>
  				<ul class="breadcrumb" style="position: static;margin-left: 0px;margin-top: 10px;" >
 				 <li><a href="roster.php">我的班表</a></li>
                  <li><a href="pay.php">員工薪資紀錄</a></li>
                  <?php 
                  if ($privilege_left != "N") {
                      echo "<li><a href='pay_dpt.php?dID=".$dID."&sMonth=".$sMonth."'>".$sMonth."月 ".$info_dp['dName']."薪資紀錄</a></li>";
                    }
                    ?>
  					
                      <li><?php echo $eName.'_'.$sMonth.'月'?>薪資紀錄</li>
				</ul>
			</div>


<h1><?php echo $eName.'<br>'.$sMonth.'月'?>薪資紀錄</h1>

<hr style="border-top: 1px solid lightgray;">
<?php
if ($info != true) {
    echo "無任何資料顯示...";
} else {
    echo ''
?>

    <form method="post" action="epy_drop.php?dID=<?php echo $dID; ?>" onSubmit="return chkinput(this)">
        <table id="RWD_table" width="auto" border="0" align="center" cellpadding="0" cellspacing="1">
            <thead>
                <tr>
                    
                    <th>上班月份</th>
                    <th>員工姓名</th>
                    <th>上班總天數</th>
                    <th>上班總時數</th>
                    <th>薪資概況</th>
                </tr>
            </thead>

                <tr>
                    
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info["sMonth"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info["eName"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info["sum_day"]; ?></a></div>
                    </td>
                    
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info["sum_hour"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info["money"]; ?></div>
                    </td>
                    
                </tr>

            <tr>
                <td colspan="9" style="width: 1000px;">&nbsp;</td>
            </tr>

        </table>
    </form>

<?php

}
?>
</div>
