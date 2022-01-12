<title>SA排班-新建班表</title>

<?php

include("conn.php");
include("week.php");
include("roster_left.php");

$dID = $_GET['dID'];
$sMonth = $_GET['sMonth'];

#echo $dID.$sMonth;

$saYear = substr($sMonth, 0, 4); #排班年份
$saMonth = substr($sMonth, -2); #排班月份


if ($saMonth == 4 | $saMonth == 6 | $saMonth == 9 | $saMonth == 11) {
    $saDays = 30;
} elseif ($saMonth == 2) {
    $saDays = 28;
} else {
    $saDays = 31;
}

/*抓取上班人員 Start */
$a = array('epy');

    /*查詢分店人數*/
$sql = mysqli_query($conn, "select * from employee where dID='" . $dID . "'");
$info = mysqli_fetch_array($sql);

/*查詢分店資訊*/
$sql_dp = mysqli_query($conn, "select * from department where dID='" . $dID . "'");
$info_dp = mysqli_fetch_array($sql_dp);

    /*查詢d_time*/
$sql_d = mysqli_query($conn, "select * from d_time where dID='" . $dID . "'");
$info_d = mysqli_fetch_array($sql_d);

do {
    array_push($a, $info['eID']);
} while ($info = mysqli_fetch_array($sql));

$aleng = count($a);
#print_r($a);
/*抓取上班人員 End */

$sa=array(array('D'),array('E'));
$i=1;

do{
    
    $w=$weekarray[date("w", strtotime($sMonth . '-' . $i))];
    if($w == $weekarray[0] | $w == $weekarray[6]){
        array_push($sa[0],'break');
        array_push($sa[1],'break');
        
    }
    else{
        
        array_push($sa[0],array($a[1]));
        array_push($sa[1],array($a[2]));

    }


    $i+=1;
}while($i <= $saDays);
#print_r($sa);
#echo '<br>********************************<br>';

if($info_d['D_epy_num']>1){
    
    for($i=1;$i<=$saDays;$i++){
        for($j=1;$j<$info_d['D_epy_num'];$j++){
            if($sa[0][$i] != 'break'){
                if(in_array($a[$j+2], $sa[1][$i]) || in_array($a[$j+2], $sa[0][$i])){

                    while(in_array($a[$j+2], $sa[1][$i]) || in_array($a[$j+2], $sa[0][$i])){

                        $j+=1;
                    }

                    array_push($sa[0][$i],$a[$j+2]);
                    $j--;
                }
                else{
                    array_push($sa[0][$i],$a[$j+2]);
                }
                
            }
            
        }
    }
    
}

if($info_d['E_epy_num']>1){
    
    for($i=1;$i<=$saDays;$i++){
        for($j=1;$j<$info_d['E_epy_num'];$j++){
            if($sa[1][$i] != 'break'){
                
                if(in_array($a[$j+2], $sa[1][$i]) || in_array($a[$j+2], $sa[0][$i])){

                    while(in_array($a[$j+2], $sa[1][$i]) || in_array($a[$j+2], $sa[0][$i])){

                        $j+=1;
                    }

                    array_push($sa[1][$i],$a[$j+2]);
                    $j--;
                }
                else{
                    array_push($sa[1][$i],$a[$j+2]);
                }
                
            }
            
        }
    }
    
}

#print_r($sa);
?>


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
<link href="../css/table.css" rel="stylesheet">
<div class="content">

    <h1 align="left">新建班表</h1>
    <h4 align="left"><?php echo $sMonth.$info_dp['dName'];?></h4>
    <div style="width:80%">
    <form method="post" action="set3.php?dID=<?php echo $dID; ?>&saDays=<?php echo $saDays; ?>&sMonth=<?php echo $sMonth; ?>" onSubmit="return chkinput(this)">
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
            
            #查詢分店人數
            $sql = mysqli_query($conn, "select * from employee where dID='" . $dID . "'");
            $info = mysqli_fetch_array($sql);
            
            do{
            ?>
                        <tr>
                            <td height="47"><?php echo $info['eName'];if($info['etype'] == 'pt'){echo '(PT)';}?></td>
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
            #查詢分店人數
            $sql = mysqli_query($conn, "select * from employee where dID='" . $dID . "'");
            $info = mysqli_fetch_array($sql);

            $i = 1;
            do {
                    do { 
                        
                        ?>
                        <td height="25" bgcolor="#FFFFFF">
                            <div align="center">
                            
                                <select name="<?php echo $info['eID'] . '_' . $i; ?>" style="border: 0;font-size: 20px;">
                                    <?php
                                    
                                    if (in_array($info['eID'], $sa[0][$i])) {
                                        echo '
                                <option value="D" selected>早</option>
                                <option value="E">晚</option>
                                <option value="B">休</option>
                                ';
                                    }  elseif (in_array($info['eID'], $sa[1][$i])) {
                                        echo '
                                <option value="D">早</option>
                                <option value="E" selected>晚</option>
                                <option value="B">休</option>
                                ';
                                    }else {
                                        echo '
                                <option value="D">早</option>
                                <option value="E">晚</option>
                                <option value="B" selected>休</option>
                                ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    <?php
                        
                        $i += 1;
                    } while ($i <= $saDays );
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
            <td><textarea name="remark" rows="3" style="width:60% ;border:1px solid lightgray;" placeholder="字數最多100字"></textarea></td>
        </tr>

            <tr>
                <td><input class="danger_btn" type="reset" name="reset" id="reset" value="Reset"></td>
                <td><input class="chk_btn" type="submit" name="submit" id="submit" value="確認班表"></td>
            </tr>
        </table>
        </form>
    </div>


</div>