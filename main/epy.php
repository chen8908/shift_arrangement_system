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
include("privilege_BY.php");
$dID = $_GET['dID'];

/*SQL 搜尋分店*/
$sql = mysqli_query($conn,"select * from department where dID='" . $dID . "'");
$info = mysqli_fetch_array($sql);

/*SQL 搜尋員工*/
$sql1 = mysqli_query($conn,"select * from employee where dID='" . $dID . "'");
$info1 = mysqli_fetch_array($sql1); 

/*分店所需上班人力加總-兩班制*/
$sql_need=mysqli_query($conn,"select D_epy_num + E_epy_num as A from d_time where dID='".$dID."'");
$info_need=mysqli_fetch_array($sql_need);

/*分店所需上班人力加總-兩班制*/
$sql_need_t3=mysqli_query($conn,"select D_epy_num + E_epy_num + N_epy_num as B from d_time where dID='".$dID."'");
$info_need_t3=mysqli_fetch_array($sql_need_t3);

$sql_d=mysqli_query($conn,"select * from d_time where dID= '" . $dID . "'");
$info_d=mysqli_fetch_array($sql_d);
?>
<!--Title-->
<title>SA排班-<?php echo $info["dName"] ?></title>


<div class="content">

<!--麵包屑-->
<div>
  				<ul class="breadcrumb" style="position: static;margin-left: 0px;margin-top: 10px;" >
 				 <li><a href="roster.php">我的班表</a></li>
  					<li><a href="epy_group.php">建立員工群組</a></li>
                      <li><?php echo $info["dName"] ?></li>
				</ul>
			</div>

<?php
/*Top name*/
echo "<h1>" . $info["dID"] . "_" . "&nbsp;" . $info["dName"] . "(" . $info["degName"] . ")" . "</h1>";
?>

<script language="javascript">
    function chkinput(form) {
        var yes = confirm('確定要執行刪除嗎?');
        if (yes) {
            return (true);
        } else {
            return (false);
        }
    }
</script>

<?php
if($privilege_left !='B' && $dID_left != $dID){
    echo '<div style="display:none">';
}
?>
<button onclick="location.href='epy_add.php?dID=<?php echo $dID; ?> & dName=<?php echo $info['dName']; ?>'">新增員工</button>
<?php
if($privilege_left !='B' && $dID_left != $dID){
    echo '</div>';
}
?>

<small>最佳人力建議:<?php 
    if($info_d['dtype'] == 't1'){
        echo $info_need[0];
    }
    elseif($info_d['dtype'] == 't2'){
        echo $info_need[0]+1;
    }
    elseif($info_d['dtype'] == 't3'){
        echo $info_need_t3[0]+1;
    }
    else{ echo 'Error';}
    ?>FT</small>
<hr style="border-top: 1px solid lightgray;">
<?php
if ($info1 != true) {
    echo "無任何資料顯示...";
} else {
    echo ''
?>

    <form method="post" action="epy_drop.php?dID=<?php echo $dID; ?>" onSubmit="return chkinput(this)">
        <table id="RWD_table" width="auto" border="0" align="center" cellpadding="0" cellspacing="1">
            <thead>
                <tr>
                    <?php if($privilege_left =='B' or $dID_left == $dID){echo '<th>複選</th>';}?>
                    <th>編號</th>
                    <th>姓名</th>
                    <th>電話</th>
                    <th>職稱</th>
                    <th>月薪</th>
                    <th>時薪</th>
                    <th>權限</th>
                    <?php if($privilege_left =='B' or $dID_left == $dID){echo '<th>操作</th>';}?>
                            
                </tr>
            </thead>
            <?php
            do {
            ?>
                <tr>
                    <?php if($privilege_left =='B' or $dID_left == $dID){echo '
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center">
                            <input type="checkbox" id="checkbox" name="'.$info1["eID"].'" value=". $info1["eID"].">
                        </div>
                    </td>';}?>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info1["eID"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info1["eName"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><a href="tel:<?php echo $info1["ephone"]; ?>"><?php echo $info1["ephone"]; ?></a></div>
                    </td>
                    <?php
                    if ($info1["etype"] == "ft") {
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">正職</div></td>';
                    } else {
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">兼職</div></td>';
                    }
                    ?>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info1["mon_rate"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info1["hor_rate"]; ?></div>
                    </td>
                    <?php
                    if ($info1["privilege"] == "Y") {
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">中階主管</div></td>';
                    } 
                    elseif($info1["privilege"] == "B"){
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">高階主管</div></td>';
                    }
                    else {
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">一般職員</div></td>';
                    }
                    ?>
                    
                    <?php if($privilege_left =='B' or $dID_left == $dID){echo '
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><a href="epy_edit.php?eID='. $info1["eID"].'">更改</a></div>
                    </td>';}?>


                </tr>

            <?php
            } while ($info1 = mysqli_fetch_array($sql1));

            ?>

            <tr>
                <td colspan="9" style="width: 1500px;">&nbsp;</td>
            </tr>
            <?php
            if($privilege_left =='B' or $dID_left == $dID){
                echo '            
                <tr>
                    <td align="right" colspan="9">
                    <input class="danger_btn" type="submit" name="submit" id="submit" value="刪除">
                    <input class="chk_btn" type="reset" name="reset" id="reset" value="重新選擇">
                    </td>
                    
                </tr>';
            }
            ?>
        </table>
    </form>

<?php

}
?>
</div>
