

<script language="javascript">
  function chkinput(form)
  {
    if(form.eID.value=="")
	{
	 alert("請輸入主管編號!");
	 form.eID.select();
	 return(false);
	}
    if(form.eName.value=="")
	{
	 alert("請輸入主管姓名!");
	 form.eName.select();
	 return(false);
	}
    if(form.privilege.value=="")
	{
	 alert("請選擇權限!");
	 return(false);
	}
   return(true);
  }
</script>

<?php 

include("roster_left.php");
include("conn.php");
include("privilege_B.php");



/*echo "<h1>新增 ".$dID.$dName." 主管資料</h1>";

$sql = mysqli_query($conn, "select * from department where dID='" . $dID . "'");
$info = mysqli_fetch_array($sql);*/

?>
<title>SA排班-新增 主管資料</title>
<div class="content" style="margin:0;">
<h1 align="center">新增 主管資料</h1>
<form method="POST" action="leader_add_save.php" onSubmit="return chkinput(this)">
    <table align="center">

        <tr>
            <td align="center"><span style="color: #FF0000">* 為必填項目</span></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                主管編號(ID)<span style="color: #FF0000">*</span><br>
                <input type="text" id="eID" name="eID" class="textbox" placeholder="輸入主管編號" value="SUP">
            </td>
        </tr>

        <tr>
            <td>
                密碼<br>
                <input type="text"  class="textbox" placeholder="預設密碼與編號相同" disabled="disabled">
            </td>
        </tr>
        <tr>
            <td>
                主管姓名<span style="color: #FF0000">*</span><br>
                <input type="text" id="eName" name="eName" class="textbox" placeholder="輸入姓名">
            </td>
        </tr>
        <tr>
            <td>
                主管電話<br>
                <input type="text" id="ephone" name="ephone" class="textbox" placeholder="輸入電話">
            </td>
        </tr>
        
        <tr>
            <td>
                權限設定<span style="color: #FF0000">*</span><br>
                <input type="radio" name="privilege" id="privilege" value="B" checked>高階主管<br>
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

</div>