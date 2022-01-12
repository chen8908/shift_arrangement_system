<?php
include("conn.php");
include("roster_left.php");
include("privilege_BY.php");

$dID=$_GET['dID'];
$sMonth=$_GET['sMonth'];


#SQL查詢department
$sql=mysqli_query($conn,"select * from department where dID='$dID'");
$info=mysqli_fetch_array($sql);
?>


<title>SA排班-<?php echo $sMonth.'月 '.$info['dName'];?> 薪資紀錄</title>

<link rel="stylesheet" href="../css/breadcrumb.css">
<link rel="stylesheet" href="../css/main2.css">


<script language="javascript">

  function chkDrop(x)
  {
    var yes = confirm('你確定刪除分店 "'+x+'" 嗎？\n\n(相關員工資料可能也將會消失)');
    
    if (yes) {
      
        location.href='dpt_drop.php?dID='+x;
    }
  }
</script>

<div class="content">
  <!--麵包屑-->
  <div>
  				<ul class="breadcrumb" style="position: static;margin-left: 0px;margin-top: 10px;" >
 				 <li><a href="roster.php">我的班表</a></li>
                  <li><a href="pay.php">員工薪資紀錄</a></li>
  					<li><?php echo $sMonth.'月 '.$info['dName']?>薪資紀錄</li>
				</ul>
			</div>


<h1><?php echo $sMonth.'月<br>'.$info['dName']?>薪資紀錄</h1>

<hr style="border-top: 1px solid lightgray;">


<?php
#SQL查詢pay
$sql=mysqli_query($conn,"select * from pay where dID='".$dID."' and sMonth='".$sMonth."'");
$info=mysqli_fetch_array($sql);


if ($info != true) {
	echo "<div style='text-align:center;'><h2>您尚未建立此班表...</h2><br><img style='width:400px' src='../images/start.png'></div>";
} else {
	echo '' ?>

	<?php

    do{
		#SQL查詢employee
		$sql_epy=mysqli_query($conn,"select * from employee where eName='".$info['eName']."' and dID='".$dID."'");
		$info_epy=mysqli_fetch_array($sql_epy);
?>
			<div class="epy_block">
  			<a href="pay_epy.php?dID=<?php echo $dID?>&sMonth=<?php echo $sMonth?>&eName=<?php echo $info['eName']?>">
              <div class="epy_block_name"><?php echo $info["eName"]; if($info_epy['etype'] == 'pt'){echo '(pt)';}?>_薪資紀錄</div>
            </a>
			<div class="epy_block_footer">
				
  				<div class="epy_block_drop">
				</div>
				
			</div>
		</div> 

<?php
	 }while($info=mysqli_fetch_array($sql));
?>
    <?php

}
?>

</div>