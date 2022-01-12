
<?php
include("conn.php");
include("week.php");
include("roster_left.php");

$dID = $_GET['dID'];
$sMonth = $_GET['sMonth'];

#echo $sMonth.'-1';
#echo gettype('1');
#echo $dID.'<br>'.$sMonth;

$saYear = substr($sMonth, 0, 4); #排班年份
$saMonth = substr($sMonth, -2); #排班月份


if ($saMonth == 4 | $saMonth == 6 | $saMonth == 9 | $saMonth == 11) {
    $saDays = 30;
} elseif ($saMonth == 2) {
    $saDays = 28;
} else {
    $saDays = 31;
}

/*SQL 搜尋分店月份班表*/
$sql_sf = mysqli_query($conn, "select * from shift where sMonth='" . $sMonth . "' and dID='" . $dID . "'");
$info_sf = mysqli_fetch_array($sql_sf);

/*SQL 搜尋分店月份班表資訊*/
$sql_sf_in = mysqli_query($conn, "select * from shift_info where sMonth='" . $sMonth . "' and dID='" . $dID . "'");
$info_sf_in = mysqli_fetch_array($sql_sf_in);

/*SQL 搜尋分店*/
$sql_dp = mysqli_query($conn, "select * from department where dID='" . $dID . "'");
$info_dp = mysqli_fetch_array($sql_dp);
?>
<title>SA排班-修改<?php echo $sMonth ?> 月 <?php echo $info_dp["dName"] ?>班表</title>

<style>
    #RWD_table{
        display: block;
    overflow-x: auto;
    white-space: nowrap;
    }
</style>
<link href="../css/table.css" rel="stylesheet">
<div class="content">

    <h1>修改 <?php echo $sMonth ?> 月 <?php echo $info_dp["dName"] ?>班表</h1>
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
<form method="post" action="roster_shift_edit_save.php?dID=<?php echo $dID; ?>&sMonth=<?php echo $sMonth; ?>&saDays=<?php echo $saDays; ?>" onSubmit="return chkinput(this)">
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
                            <td height="47"><?php echo $info['eName']?></td>
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


/*查詢班表*/
$sql = mysqli_query($conn, "SELECT eName,COUNT(*) as cou from shift where sMonth='$sMonth' and dID='$dID' GROUP BY eName");
$info = mysqli_fetch_array($sql);
        $i=1;
            do {
                /*SQL 搜尋分店月份班表*/
                $sql_shift = mysqli_query($conn, "select * from shift where sMonth='" . $sMonth . "' and dID='" . $dID . "' and eName='" . $info['eName'] . "'");
                $info_shift = mysqli_fetch_array($sql_shift);

                    do { ?>
                        <td height="25" bgcolor="#FFFFFF">
                            <div align="center">
                            <select name="<?php echo $info['eName'].'_'.$i;?>" style="border: 0;font-size: 20px;">
                            <?php
                                    if ($info_shift['time'] == 'D') {
                                        echo'
                                        <option value="D" selected>早</option>
                                        <option value="E">晚</option>
                                        <option value="N">大夜</option>
                                        <option value="B">休</option>
                                        ';
                                    } elseif ($info_shift['time'] == 'E') {
                                        echo'
                                            <option value="D">早</option>
                                            <option value="E" selected>晚</option>
                                            <option value="N">大夜</option>
                                            <option value="B">休</option>
                                            ';
                                    }elseif ($info_shift['time'] == 'N') {
                                        echo'
                                            <option value="D">早</option>
                                            <option value="E">晚</option>
                                            <option value="N" selected>大夜</option>
                                            <option value="B">休</option>
                                            ';
                                    } elseif ($info_shift['time'] == 'B') {
                                        echo'
                                            <option value="D">早</option>
                                            <option value="E">晚</option>
                                            <option value="N">大夜</option>
                                            <option value="B" selected>休</option>
                                            ';
                                    } else {
                                        echo 'error';
                                    }
                                    ?>
                            </select>
                            </div>
                        </td>
                        <?php
                    $i+=1;
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

            <tr>
            
            <td>備註</td>
            <td><textarea name="remark" rows="3" style="width:60% ;border:1px solid lightgray;" placeholder="字數最多100字"><?php echo $info_sf_in['remark'];?></textarea></td>
        </tr>

            <tr>
            <td><input class="danger_btn" type="reset" name="reset" id="reset" value="Reset"></td>

            <td><input class="chk_btn" type="submit" name="submit" id="submit" value="修改完成"></td>
            
            </tr>
        </table>
        </form>
    </div>

</div>
