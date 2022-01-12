
<!--Title-->
<title>SA排班-修改個人資訊</title>
<link rel="icon" type="image/png" href="https://i.imgur.com/NVquZaa.png">
<link rel="stylesheet" href="../css/main2.css">

<?php
include("conn.php");
include("roster_left.php");

$eID = $eID_left;
$privilege = $privilege_left;
#echo $eID;

if($privilege == "B"){
    $sql = mysqli_query($conn,"select * from leader where eID='" . $eID . "'");
    $info = mysqli_fetch_array($sql);
}
else{
    $sql = mysqli_query($conn,"select * from employee where eID='" . $eID . "'");
    $info = mysqli_fetch_array($sql);
}



?>

<script language="javascript">

  function chkinput(form)
  {
    
	
    if(form.eName.value=="")
	{
	 alert("請輸入員工姓名!");
	 form.eName.select();
	 return(false);
	}
   return(true);
  }

    function chkpassedit(x) {
        var yes = confirm('確定將密碼設為預設嗎?');

        if (yes) {
            location.href = 'epy_edit_pass.php?eID='+x;
        }
    }
</script>

<div class="content" style="margin:0;">
<h1 align="center">修改 個人資訊</h1>
<form method="POST" action="person_edit_save.php?eID=<?php echo $eID ?>" onSubmit="return chkinput(this)">
    <table align="center">

        <tr>
            
            <td align="center"><span style="color: #FF0000">* 為必填項目</span></td>
        </tr>
        <tr>
            <td>
                員工編號(ID)(不可變更)<br>
                <input type="text" id="eID" name="eID" class="textbox" placeholder="輸入員工編號" value="<?php echo $eID; ?>" disabled="disabled"><br>
            </td>
        </tr>


        <tr>
            <td>
                員工姓名<span style="color: #FF0000">*</span><br>
                <input type="text" id="eName" name="eName" class="textbox" placeholder="輸入姓名" value="<?php echo $info['eName']; ?>"><br>
            </td>
        </tr>
        <tr>
            <td>
                員工電話<br>
                <input type="text" id="ephone" name="ephone" class="textbox" placeholder="輸入電話" value="<?php echo $info['ephone']; ?>"><br>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="center">
                <input type="submit" name="submit" id="submit" class="submit" value="送出">
            </td>
        </tr>
    </table>
</form>

<style>
.key{
  width: 200px;margin: 0 auto;padding:10px;border-top:1px solid lightgrey;color: black;transition-duration: 0.4s;border-radius: 5px;
}
.key:hover{
  background-color:lightgrey;text-decoration:none;

}
</style>
<a href="person_key_edit.php?eID=<?php echo $eID;?>" style="text-decoration:none;">
<div class="key">
<img src="../images/key.png" alt="" style="width:30px;">
更新密碼
</div>
</a>

</div>