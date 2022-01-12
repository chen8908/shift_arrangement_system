<?php

include("roster_left.php");
include("conn.php");
#include("roster_center.php")
?>
<title>SA排班-我的班表</title>
<!--<link rel="stylesheet" href="../css/main.css">-->
<link rel="stylesheet" href="../css/breadcrumb.css">

<div class="content">
  <!--麵包屑-->
  <div>
  				<ul class="breadcrumb" style="position: static;margin-left: 0px;margin-top: 10px;" >
 				 <li>我的班表</li>
				</ul>
			</div>
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
            echo "<div style='text-align:center;'><h1>目前尚無相關班表~</h1><img style='width:380px' src='../images/clock.png'></div>";
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
                    <a href="roster_shift.php?dID=<?php echo $info['dID'] ?>&sMonth=<?php echo $info['sMonth'] ?>">
                        <div class="epy_block_name"><?php echo substr($info_gb['sMonth'], -2) . "月_" . $info_dp["dName"] . " 班表"; ?></div>
                    </a>
                    <div class="epy_block_footer" style="padding-left:5px;">
                        <img src="../images/info.png" style="width: 15px;">
                        <small style="color:gray;padding-top:5px;"> <?php echo $info['set_date']; ?></small>
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