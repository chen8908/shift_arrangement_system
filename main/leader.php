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
include("privilege_B.php");



/*SQL 搜尋員工*/
$sql = mysqli_query($conn,"select * from leader");
$info = mysqli_fetch_array($sql); 

/*分店所需上班人力加總
$sql_need=mysqli_query($conn,"select D_epy_num + E_epy_num as B from d_time where dID='".$dID."'");
$info_need=mysqli_fetch_array($sql_need);*/

?>
<!--Title-->
<title>SA排班-高階主管群</title>


<div class="content">

<!--麵包屑-->
<div>
  				<ul class="breadcrumb" style="position: static;margin-left: 0px;margin-top: 10px;" >
 				 <li><a href="roster.php">我的班表</a></li>
  					<li>高階主管群</li>
				</ul>
			</div>

<h1>高階主管群</h1>

<?php
/*Top name
echo "<h1>" . $info["dID"] . "_" . "&nbsp;" . $info["dName"] . "(" . $info["degName"] . ")" . "</h1>";*/
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


<button onclick="location.href='leader_add.php'">新增高階主管</button>


<hr style="border-top: 1px solid lightgray;">
<?php
if ($info != true) {
    echo "無任何資料顯示...";
} else {
    echo ''
?>
<style>
    table{
        display: block;
    overflow-x: auto;
    white-space: nowrap;
    }
</style>
    <form method="post" action="leader_drop.php" onSubmit="return chkinput(this)">
        <table id="RWD_table" width="auto" border="0" align="center" cellpadding="0" cellspacing="1">
            <thead>
                <tr>
                    <?php if($privilege_left =='B' or $dID_left == $dID){echo '<th>複選</th>';}?>
                    <th>編號</th>
                    <th>姓名</th>
                    <th>電話</th>
                    <th>權限</th>
                            
                </tr>
            </thead>
            <?php
            do {
            ?>
                <tr>
                    <?php if($privilege_left =='B' or $dID_left == $dID){echo '
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center">
                            <input type="checkbox" id="checkbox" name="'.$info["eID"].'" value=". $info["eID"].">
                        </div>
                    </td>';}?>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info["eID"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info["eName"]; ?></div>
                    </td>
                    <td height="25" bgcolor="#FFFFFF">
                        <div align="center"><a href="tel:<?php echo $info["ephone"]; ?>"><?php echo $info["ephone"]; ?></a></div>
                    </td>
                    
                    <?php
                    if ($info["privilege"] == "Y") {
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">中階主管</div></td>';
                    } 
                    elseif($info["privilege"] == "B"){
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">高階主管</div></td>';
                    }
                    else {
                        echo '<td height="25" bgcolor="#FFFFFF"><div align="center">一般職員</div></td>';
                    }
                    ?>



                </tr>

            <?php
            } while ($info = mysqli_fetch_array($sql));

            ?>

            <tr>
                <td colspan="9" style="width: 1300px;">&nbsp;</td>
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
