

<script language="javascript">
  function chkinput(form)
  {
    if(form.eID.value=="")
	{
	 alert("請輸入員工編號!");
	 form.eID.select();
	 return(false);
	}
    if(form.eName.value=="")
	{
	 alert("請輸入員工姓名!");
	 form.eName.select();
	 return(false);
	}
    if(form.etype.value=="")
	{
	 alert("請選擇職稱!");
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
<style>
	input[type="radio"]:checked + .theinput {
    display: inline-block;
}
	
	.theinput {
  display: none;  
}
	
	</style>	
<?php 

include("roster_left.php");
include("conn.php");
include("privilege_BY.php");

$dID=$_GET['dID'];
$dName=$_GET['dName'];

/*echo "<h1>新增 ".$dID.$dName." 員工資料</h1>";*/

$sql = mysqli_query($conn, "select * from department where dID='" . $dID . "'");
$info = mysqli_fetch_array($sql);

?>
<title>SA排班-新增 <?php echo $dName; ?> 員工</title>
<div class="content" style="margin:0;">
<h1 align="center">新增 <?php echo $dName;?>員工資料</h1>
<form method="POST" action="epy_add_save.php?dID=<?php echo $dID; ?>" onSubmit="return chkinput(this)">
    <table align="center">

        <tr>
            <td align="center"><span style="color: #FF0000">* 為必填項目</span></td>
        </tr>
        <tr>
            <td>
                員工編號(ID)<span style="color: #FF0000">*</span><br>
                <input type="text" id="eID" name="eID" class="textbox" placeholder="輸入員工編號" value="<?php echo $info['degName']?>">
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
                員工姓名<span style="color: #FF0000">*</span><br>
                <input type="text" id="eName" name="eName" class="textbox" placeholder="輸入姓名">
            </td>
        </tr>
        <tr>
            <td>
                員工電話<br>
                <input type="text" id="ephone" name="ephone" class="textbox" placeholder="輸入電話">
            </td>
        </tr>

        <tr>
            <td>
                員工職稱類型<span style="color: #FF0000">*</span><br>
                <ul>
                    
					<div><li>	
                     	<input id="radio1" name="etype" type="radio" value="ft">正職
   						<input style="width: 100px;" class="textbox theinput" name="mon_rate"  type="text" placeholder="請輸入月薪">
					</li></div>
						
                    
                    <div><li>
                    	<input id="radio2" name="etype" type="radio" value="pt">兼職
    					<input style="width: 100px;" class="textbox theinput" name="hor_rate" type="text" placeholder="請輸入時薪">
                    </li></div>
					
					
                </ul>
                
            </td>
        </tr>
        <tr>
            <td>
                權限設定<span style="color: #FF0000">*</span><br>
                <!--<input type="radio" name="privilege" id="privilege" value="B">高階主管<br>-->
                <input type="radio" name="privilege" id="privilege" value="Y">中階主管<br>
                <input type="radio" name="privilege" id="privilege" value="N">一般職員<br>
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