<?php
include("conn.php");
include("roster_left.php");
include("privilege_BY.php");
?>
<title>SA排班-建立員工群組</title>

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
  					<li>建立員工群組</li>
				</ul>
			</div>


<h1>建立員工群組</h1>
<?php 
    if ($privilege_left == "N" or $privilege_left == "Y") {
      echo '<div style="display:none">';
  }
    ?>
<button onclick="location.href='dpt_add.php'">新增分店</button>

<?php 
    if ($privilege_left == "N" or $privilege_left == "Y") {
      echo '</div>';
  }
    ?>

<hr style="border-top: 1px solid lightgray;">




<?php
#SQL查詢department
$sql=mysqli_query($conn,"select * from department");
$info=mysqli_fetch_array($sql);

if ($info != true) {
	echo "<div style='text-align:center;'><h2>您尚未建立部門...</h2><br><img style='width:400px' src='../images/start.png'></div>";
} else {
	echo '' ?>

	<?php

    do{
?>

			<div class="epy_block">
  			<a href="epy.php?dID=<?php echo $info['dID']?>"><div class="epy_block_name"><?php echo  $info["dID"]."_".$info["dName"]."(".$info["degName"].")"; ?></div></a>
			<div class="epy_block_footer">
				<?php 
					if ($privilege_left == "N" or $privilege_left == "Y") {
					echo '<div style="display:none">';
				}
    			?>
  				<div class="epy_block_drop">
  					<a href="#"  name="<?php echo $info["dID"]?>" onclick="chkDrop(name)"><img src="../images/delete.png" onMouseOver="this.src='../images/delete_hover.png';" onMouseOut="this.src='../images/delete.png';" title="刪除" alt=""></a>
					<a name="<?php echo $info["dID"]?>" href='dpt_edit.php?dID=<?php echo $info["dID"]?>'><img src="../images/writing.png" onMouseOver="this.src='../images/writing-hover.png';" onMouseOut="this.src='../images/writing.png';" title="修改資訊" alt=""></a>
				</div>
				<?php 
					if ($privilege_left == "N" or $privilege_left == "Y") {
					echo '</div>';
				}
					?>
			</div>
		</div> 

<?php
	 }while($info=mysqli_fetch_array($sql));
?>
    <?php

}
?>

</div>