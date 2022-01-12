

<!--Title-->
<title>SA排班-修改個人資訊</title>
<link rel="icon" type="image/png" href="https://i.imgur.com/NVquZaa.png">
<link rel="stylesheet" href="../css/main2.css">

<?php 

include("conn.php");
include("roster_left.php");

$eID=$_GET['eID'];

$sql = mysqli_query($conn,"select * from employee where eID='" . $eID . "'");
$info = mysqli_fetch_array($sql);

?>
<style>
.next{
    padding: 0;
    height: 30px;
    margin-left: 10px;
    border-radius: 50px;
    width: 30px;
    border: 0;
}
.next:hover{
    background-color: lightgrey;
}
</style>
<div class="content" style="text-align: center;margin:0px;">
<h1 align="center">輸入密碼</h1>
    <form id="form" action="person_key_edit_chk.php?eID=<?php echo $eID?>" method="POST" onSubmit="return chkinput(this)">
        <table align="center">
        <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    密碼<br>
                    <input type="password" id="epw" name="epw" class="textbox" placeholder="您的密碼">

                </td>

                <td align="center">
                    &nbsp;<br>
                    <input class="next" type="submit" id="submit" name="submit" value="➜" style="padding: 0;height: 30px;" title="下一步">

                </td>

            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    您不是 <?php echo $eName_left ?>?
                    <a style="color: #F7C242;" role="button" href="logout.php">立即登出</a>
                </td>
            </tr>
        </table>
    </form>

</div>