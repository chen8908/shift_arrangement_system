<head>

    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
    <link href="../css/table.css" rel="stylesheet">
    <script type="text/javascript" src="../js/table.js"></script>
    <link rel="stylesheet" href="../css/breadcrumb.css">
    <link rel="stylesheet" href="../css/main2.css">

</head>

<script language="javascript">
    function chkinput(form) {
        var yes = confirm('確定要執行刪除班表嗎?');
        if (yes) {
            return (true);
        } else {
            return (false);
        }
    }
</script>

<?php
include("conn.php");
include("week.php");
include("roster_left.php");

$dID = $_GET['dID'];
$sMonth = $_GET['sMonth'];

$saMonth = substr($sMonth, -2);

if ($saMonth == 4 | $saMonth == 6 | $saMonth == 9 | $saMonth == 11) {
    $saDays = 30;
} elseif ($saMonth == 2) {
    $saDays = 28;
} else {
    $saDays = 31;
}

/*SQL 搜尋分店*/
$sql_dp = mysqli_query($conn, "select * from department where dID='" . $dID . "'");
$info_dp = mysqli_fetch_array($sql_dp);

/*SQL 搜尋建置日期*/
$sql_sf_in = mysqli_query($conn, "select * from shift_info where sMonth='" . $sMonth . "' and dID='" . $dID . "'");
$info_sf_in = mysqli_fetch_array($sql_sf_in);

/*SQL 搜尋分店月份班表*/
$sql_sf = mysqli_query($conn, "select * from shift where sMonth='" . $sMonth . "' and dID='" . $dID . "'");
$info_sf = mysqli_fetch_array($sql_sf);

?>
<!--Title-->
<title>SA排班-<?php echo $sMonth . "月" . $info_dp["dName"] ?>班表</title>


<div class="content">

    <!--麵包屑-->
    <div>
        <ul class="breadcrumb" style="position: static;margin-left: 0px;margin-top: 10px;">
            <li><a href="roster.php">我的班表</a></li>
            <li><?php echo $sMonth ?> 月 <?php echo $info_dp["dName"] ?>班表</li>
        </ul>
    </div>

    <h1><?php echo $sMonth ?> 月</br><?php echo $info_dp["dName"] ?>班表</h1>
    <?php
    if ($info_sf != true) {
        echo "無任何資料顯示...";
    } else {
        echo ''
    ?>
    
        <small style="color:gray;">建置日期:<?php echo $info_sf_in['set_date']; ?></small>
        <hr style="border-top: 1px solid lightgray;">

        <style>
    .shift td {
        border: 1px solid lightgray;
    }

    .shift2 {
        overflow-x: scroll;
        overflow-y: auto;
        width: 900px;
        margin-left: 0px;
    }

    .left_td{
        padding-right: 0;/*padding-bottom:27.5px;*/
    }
    .left_div{
        height: 18px;
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .shift2 {
            width: 450px;
        }
        .left_td{
            padding-bottom:0;
        }
        .left_div{
            height: 9px;
        }
    }

    @media (max-width: 767px) {
        .shift2 {
            width: 250px;
        }
        .left_td{
            padding-bottom:0;
        }
        .left_div{
            height: 10px;
        }
    }
    th,td{
        height:50px;
    }
</style>

<div style="width:80%">
<form method="post" action="roster_shift_drop.php?dID=<?php echo $dID; ?>&sMonth=<?php echo $sMonth; ?>" onSubmit="return chkinput(this)">
        <table style="margin-right: 50px;">
            <tr>
                <td class="left_td">
                    
                    <table>
                        <tr>
                            <th><div style="width:85px;height:24.28px"></div></th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                        </tr>
                        <?php
                /*查詢分店人數*/
                $sql = mysqli_query($conn, "SELECT eName,COUNT(*) as cou from shift where sMonth='$sMonth' and dID='$dID' GROUP BY eName");
                $info = mysqli_fetch_array($sql);
            
            do{
                
            ?>
                        <tr>
                            <td height="47"><?php echo $info['eName'];?></td>
                        </tr>
                <?php 
                    }while($info = mysqli_fetch_array($sql))
                    ?>
                       
                    </table>
                   <div class="left_div"> </div>
                </td>
                <td style="padding-left:0;">
                    <div class='shift2'>
                        <table style='table-layout:fixed;' width="1200" class='shift'>
                        <tr>
                        <?php
                            
                            $i = 1;
                            do {
                                echo '<th  width="80">' . $weekarray[date("w", strtotime($sMonth . '-' . $i))] . '</th>';
                                $i += 1;
                            } while ($i <= $saDays);
                            ?></tr>
                            <tr>
                            <?php

                                $i = 1;
                                do {
                                    echo '<th>' . $saMonth . '/' . $i . '</th>';
                                    $i += 1;
                                } while ($i <= $saDays);
                                ?>
                            </tr>
                            <?php


/*查詢分店人數*/
$sql = mysqli_query($conn, "SELECT eName,COUNT(*) as cou from shift where sMonth='$sMonth' and dID='$dID' GROUP BY eName");
$info = mysqli_fetch_array($sql);

            do {
                /*SQL 搜尋分店月份班表*/
                $sql_shift = mysqli_query($conn, "select * from shift where sMonth='" . $sMonth . "' and dID='" . $dID . "' and eName='" . $info['eName'] . "'");
                $info_shift = mysqli_fetch_array($sql_shift);

                    do { ?>
                        <td height="25" bgcolor="#FFFFFF">
                            <div align="center">
                            <?php
                                    if ($info_shift['time'] == 'D') {
                                        echo '早';
                                    } elseif ($info_shift['time'] == 'E') {
                                        echo '晚';
                                    } elseif ($info_shift['time'] == 'N') {
                                        echo '大夜';
                                    }elseif ($info_shift['time'] == 'B') {
                                        echo '休';
                                    } else {
                                        echo 'error';
                                    }
                                    ?>
                            </div>
                        </td>
                        <?php

} while ($info_shift = mysqli_fetch_array($sql_shift));
?>
                </tr>

            <?php
                $i = 1;
            } while ($info = mysqli_fetch_array($sql));
            ?>
                            
                        </table>
                    </div>
                </td>
            </tr>
            </tr>

            <tr>
            
            <td>備註</td>
            <td><textarea name="stde" id="stde" rows="4" style="width:60%;border:0;" readonly><?php echo $info_sf_in['remark'];?></textarea></td>
        </tr>


            <tr>
            
            <td>
            <?php if ($privilege_left == "N" or $privilege_left !='B' && $dID_left != $dID) {echo '<div style="display:none">';}?>
                <input class="danger_btn" type="submit" name="submit" id="submit" value="刪除班表"> 
            <?php if ($privilege_left == "N" or $privilege_left !='B' && $dID_left != $dID){echo '</div>';}?>
            </td>
            <td>
            <?php if ($privilege_left == "N" or $privilege_left !='B' && $dID_left != $dID) {echo '<div style="display:none">';}?>
            <input class="chk_btn" type="button" onclick="location.href='roster_shift_edit.php?dID=<?php echo $dID?>&sMonth=<?php echo $sMonth?>'" value="修改">
            <?php if ($privilege_left == "N" or $privilege_left !='B' && $dID_left != $dID){echo '</div>';}?>
            </td>
           
            </tr>
 
        </table>
        </form>
    </div>
    
    <?php

    }
    ?>

</div>