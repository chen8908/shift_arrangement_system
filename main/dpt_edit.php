<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/main2.css">

<?php
include("conn.php");
$dID=$_GET['dID'];

$sql=mysqli_query($conn,"select * from department where dID='".$dID."'");
$info=mysqli_fetch_array($sql);

$sql_dt=mysqli_query($conn,"select * from d_time where dID='".$dID."'");
$info_dt=mysqli_fetch_array($sql_dt);

#echo $dID.$info['dName'].$info['degName']
include("roster_left.php");
?>
<script language="javascript">
  function chkinput(form)
  {
    if(form.dID.value=="")
	{
	 alert("請輸入分公司編號!");
	 form.dID.select();
	 return(false);
	}
	if(form.dName.value=="")
	{
	 alert("請輸入分公司名稱!");
	 form.dName.select();
	 return(false);
	}
    if(form.dtype.value=="")
	{
	 alert("請選擇班表類型!");
	 return(false);
	}
    if(form.morn1.value=="")
	{
	 alert("請填寫上班時間!");
	 form.morn1.select();
	 return(false);
	}
    if(form.morn2.value=="")
	{
	 alert("請填寫上班時間!");
	 form.morn2.select();
	 return(false);
	}
    if(form.night1.value=="")
	{
	 alert("請填寫上班時間!");
	 form.night1.select();
	 return(false);
	}
    if(form.night2.value=="")
	{
	 alert("請填寫上班時間!");
	 form.night2.select();
	 return(false);
	}
    if(form.morn_epy_num.value=="")
	{
	 alert("請填寫所需人力!");
	 form.morn_epy_num.select();
	 return(false);
	}
    if(form.night_epy_num.value=="")
	{
	 alert("請填寫所需人力!");
	 form.night_epy_num.select();
	 return(false);
	}
    
   return(true);
  }
</script>

<title>SA排班-修改 <?php echo $info['dName']?> 資訊</title>

<div class="content" style="margin:0;">
<h1 align="center">修改 <?php echo $dID.$info['dName']?> 資訊</h1>
<form method="POST" action="dpt_edit_save.php?dID=<?php echo $dID?>" onSubmit="return chkinput(this)">
    <table align="center">

        <tr>
            <td align="center"><span style="color: #FF0000">* 為必填項目</span></td>
        </tr>
        <tr>
            <td>
                編號(不可變更)<br>
                <input type="text" id="dID" name="dID" class="textbox" placeholder="輸入分公司編號" value="<?php echo $dID?>" disabled="disabled"><br>
            </td>
        </tr>
        <tr>
            <td>
                名稱<span style="color: #FF0000">*</span><br>
                <input type="text" id="dName" name="dName" class="textbox" placeholder="輸入分公司名稱" value="<?php echo $info['dName'];?>"><br>
            </td>
        </tr>
        <tr>
            <td>
                分行英文簡稱<span style="color: #FF0000">*</span><br>
                <input type="text" id="degName" name="degName" class="textbox" value="<?php echo $info['degName'];?>" placeholder="例:TP"><br>
            </td>
        </tr>
        <tr>
            <td>
                班表類型<span style="color: #FF0000">*</span><br>
                <select name="dtype" id="dtype" class="select_style">
                <?php if($info_dt['dtype'] == 't1'){
                    echo '
                    <option value="t1" selected>兩班制-周休二日制</option>
                    <option value="t2">兩班制-輪班制</option>
                    <option value="t3">三班制-輪班制</option>
                    ';}
                    elseif($info_dt['dtype'] == 't2'){
                        echo '
                    <option value="t1">兩班制-周休二日制</option>
                    <option value="t2" selected>兩班制-輪班制</option>
                    <option value="t3">三班制-輪班制</option>
                    ';}
                    elseif($info_dt['dtype'] == 't3'){
                        echo '
                    <option value="t1">兩班制-周休二日制</option>
                    <option value="t2">兩班制-輪班制</option>
                    <option value="t3" selected>三班制-輪班制</option>
                    ';}
                    else echo 'error';
                    ?>
                    

                </select>
            </td>
        </tr>

        <tr>
            <td>
                上班時間<span style="color: #FF0000">*</span><br>
                早<br>
                    <input type="time" id="D1" name="D1" class="textbox" value="<?php echo $info_dt['D1']?>" style="width:auto"> ~ <input type="time" id="D2" name="D2" class="textbox" value="<?php echo $info_dt['D2']?>" style="width:auto">
                <br>
                晚<br>
                    <input type="time" id="E1" name="E1" class="textbox" value="<?php echo $info_dt['E1']?>" style="width:auto"> ~ <input type="time" id="E2" name="E2" class="textbox" value="<?php echo $info_dt['E2']?>" style="width:auto">
                    <br>
                大夜<br>
                    <input type="time" id="N1" name="N1" class="textbox" value="<?php echo $info_dt['N1']?>" style="width:auto"> ~ <input type="time" id="N2" name="N2" class="textbox" value="<?php echo $info_dt['N2']?>" style="width:auto">
            
            </td>
        </tr>
        <tr>
            <td>
                班別所需人力<span style="color: #FF0000">*</span><br>
                早：<input type="text" id="D_epy_num" name="D_epy_num" class="textbox" style="width:30px" value="<?php echo $info_dt['D_epy_num']?>">人 &nbsp;
                晚：<input type="text" id="E_epy_num" name="E_epy_num" class="textbox" style="width:30px" value="<?php echo $info_dt['E_epy_num']?>">人 &nbsp;
                大夜：<input type="text" id="N_epy_num" name="N_epy_num" class="textbox" style="width:30px" value="<?php echo $info_dt['N_epy_num']?>">人
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

