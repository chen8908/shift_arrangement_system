<?php
include("conn.php");
include("roster_left.php");
 
?>
<title>SA排班-員工薪資紀錄</title>

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
  					<li>員工薪資紀錄</li>
				</ul>
			</div>


<h1>員工薪資紀錄</h1>


<hr style="border-top: 1px solid lightgray;">

<?php

    if($privilege_left == 'N'){
        #SQL查詢shift_info 同月份共幾筆
        $sql_gb = mysqli_query($conn, "SELECT sMonth,COUNT(*) as cou from shift_info where dID='$dID_left' GROUP BY sMonth DESC");
        $info_gb = mysqli_fetch_array($sql_gb);
    }
    else{
        #SQL查詢shift_info 同月份共幾筆
        $sql_gb = mysqli_query($conn, "SELECT sMonth,COUNT(*) as cou from shift_info GROUP BY sMonth DESC");
        $info_gb = mysqli_fetch_array($sql_gb);
    }
    
    if ($info_gb != true) {
        if($privilege_left == 'N')
        {
            echo "<div style='text-align:center;'><h1>目前尚無相關紀錄~</h1><img style='width:380px' src='../images/clock.png'></div>";
        }
        else echo "<div style='text-align:center;'><h1>快點擊功能列<br>開始您的第一個SA排班!</h1><img style='width:380px' src='../images/clock.png'></div>";
    } else {
        echo '' ?>

        <?php


        $i = 1;
        do {

            #SQL查詢shift_info
            $sql = mysqli_query($conn, "select * from shift_info where sMonth='" . $info_gb['sMonth'] . "'");
            $info = mysqli_fetch_array($sql);
            
            
        ?>

            <h1><?php echo $info_gb['sMonth']; ?></h1>
            <hr style="border-top: 1px solid lightgray;">
            <?php
            do {
                #SQL查詢department
                $sql_dp = mysqli_query($conn, "select * from department where dID='" . $info['dID'] . "'");
                $info_dp = mysqli_fetch_array($sql_dp);
            ?>
                <div class="epy_block">
					<?php 
						if($privilege_left == 'N'){
							echo "<a href='pay_epy.php?dID=".$info['dID']."&sMonth=".$info['sMonth']."&eName=".$eName_left."'>";
						}
						else{
							echo "<a href='pay_dpt.php?dID=".$info['dID']."&sMonth=".$info['sMonth']."'>";
						}
					?>
					
                    
                        <div class="epy_block_name"><?php echo substr($info_gb['sMonth'], -2) . "月_" . $info_dp["dName"] . " 薪資"; ?></div>
                    </a>
                    <div class="epy_block_footer" style="padding-left:5px;">
                        
                    </div>
                </div>
                
        <?php
                $i += 1;
            } while ($i <= $info_gb['cou'] && $info = mysqli_fetch_array($sql));
            $i = 1;
        } while ($info_gb = mysqli_fetch_array($sql_gb));

        ?>
    <?php

    }
    ?>

</div>