<title>SA排班-新建班表</title>

<?php
include("conn.php");
include("week.php");
include("roster_left.php");

$dID = $_GET['dID'];
$sMonth = $_GET['sMonth'];


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

/*查詢分店*/
$sql = mysqli_query($conn, "select * from employee where dID='" . $dID . "'");
$info = mysqli_fetch_array($sql);

do {
    array_push($a, $info['eID']);
} while ($info = mysqli_fetch_array($sql));

$aleng = count($a);
#echo "a:";
#print_r($a);
#echo "<br>";
/*亂數Start 
$Rand = array();

for ($i = 0; $i < $aleng; $i++) {
    $randval = mt_rand(0, $aleng - 1); //取得範圍為1~500亂數
    if (in_array($randval, $Rand)) { //如果已產生過迴圈重跑
        $i--;
    } else {
        $Rand[] = $randval; //若無重復則 將亂數塞入陣列
    }
}*/

/*亂數 END */
/*查詢分店資訊*/
$sql_dp = mysqli_query($conn, "select * from department where dID='" . $dID . "'");
$info_dp = mysqli_fetch_array($sql_dp);

/*查詢所需人數*/
$sql_d = mysqli_query($conn, "select * from d_time where dID='" . $dID . "'");
$info_d = mysqli_fetch_array($sql_d);

/*單一循環 Start */

$D = array();

for ($i = 1; $i < $aleng; $i++) {    
    array_push($D, array($a[$i]));
}
$Dleng = count($D);
#echo "<br>D:";
#print_r($D);


$E = array();
array_push($E, $D[$Dleng - 1]);

for ($i = 0; $i < $Dleng - 1; $i++) {
    array_push($E, $D[$i]);
}

$Eleng = count($E);

if($info_d['D_epy_num']>1){
    
    for($i=0;$i<$Dleng;$i++){
    $index=1;
        for($j=1;$j<$info_d['D_epy_num'];$j++){
            if($i+$j+1 >= $aleng){
                array_push($D[$i], $a[$index]);
                $index++;
                
            }
            else{
                array_push($D[$i], $a[$i+$j+1]);
            }
            
        }
    }
}
#echo "<br>D:";
#print_r($D);

if($info_d['E_epy_num']>1){


    for($i=0;$i<$Eleng;$i++){
        for($j=$info_d['E_epy_num'];$j>1;$j--){
            if($aleng+$i-$j >= $aleng){
                $aleng=1;
            }
            array_push($E[$i], $a[$aleng+$i-$j]);
            $aleng=count($a);
        }
    }
}


#echo "<br>E:";
#print_r($E);


/*單一循環 End */

/*早晚月份循環 Start */


$sa = array(
    array('D'),
    array('E'),
    array('N')
);


$i=1;
$d=0;
$e=0;
do{
    if($d>$Dleng-1){
        $d=0;
    }
    array_push($sa[0], $D[$d]);

    if($e>$Dleng-1){
        $e=0;
    }
    array_push($sa[1], $E[$e]);

    $i++;$d++;$e++;
}while($i<=$saDays);

#echo "<br>sa早班:";
#print_r($sa[0]);
#echo "<br>";
#echo "<br>sa晚班:";
#print_r($sa[1]);
#echo "<br>";
/*早晚月份循環 END */

/*大夜 Start*/
$N=array();

$n=1;
while(in_array($a[$n],$sa[0][1]) || in_array($a[$n],$sa[1][1]) || in_array($a[$n],$sa[0][2])){
    $n+=1;
}

$index3=1;
for($i=0;$i<$aleng-1;$i++){
    
    if($n+$i >= $aleng){
        array_push($N, array($a[$index3]));
        $index3++;
    }
    else{
        array_push($N, array($a[$n+$i]));
        
    }

}
$Nleng=count($N);

$index4=$n;

if($info_d['N_epy_num']>1){

    for($i=0;$i<$Nleng;$i++){
        for($j=1;$j<$info_d['N_epy_num'];$j++){
            if($index4+$i+$j >= $aleng){
                $index4=-$n;
            }
            array_push($N[$i], $a[$index4+$i+$j]);
            $index4=$n;
        }
    }
}

$i=1;
$n=0;
do{
    if($n>$Dleng-1){
        $n=0;
    }
    array_push($sa[2], $N[$n]);

    $i++;$n++;
}while($i<=$saDays);

#echo "<br>N:";
#print_r($N);
#echo "<br>";
#echo '<br>SA[N]:';
#print_r($sa[2]);

/*大夜 End */

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
                    }while($info = mysqli_fetch_array($sql));
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

                    do {  ?>
                        <td height="25" bgcolor="#FFFFFF">
                            <div align="center">
                                <select name="<?php echo $info['eID'] . '_' . $i; ?>" style="border: 0;font-size: 20px;">
                                    <?php
                                    
                                    if (in_array($info['eID'], $sa[0][$i])) {
                                        echo '
                                <option value="D" selected>早</option>
                                <option value="E">晚</option>
                                <option value="N">大夜</option>
                                <option value="B">休</option>
                                ';
                                    } elseif (in_array($info['eID'], $sa[1][$i])) {
                                        echo '
                                <option value="D">早</option>
                                <option value="E" selected>晚</option>
                                <option value="N">大夜</option>
                                <option value="B">休</option>
                                ';} 
                                elseif (in_array($info['eID'], $sa[2][$i])) {
                                    echo '
                            <option value="D">早</option>
                            <option value="E">晚</option>
                            <option value="N" selected>大夜</option>
                            <option value="B">休</option>
                            ';}
                                else {echo '
                                <option value="D">早</option>
                                <option value="E">晚</option>
                                <option value="N">大夜</option>
                                <option value="B" selected>休</option>
                                ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    <?php
                        $i += 1;
                    } while ($i <= $saDays);
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