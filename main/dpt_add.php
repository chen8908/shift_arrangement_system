
<title>SA排班-新增分店</title>

<?php
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

<div class="content" style="margin:0;">
<h1 align="center">新增分店</h1>

<form method="POST" action="dpt_add_save.php" onSubmit="return chkinput(this)">
    <table align="center">

        <tr>
            <td align="center"><span style="color: #FF0000">* 為必填項目</span></td>
        </tr>
        <tr>
            <td>
                編號<span style="color: #FF0000">*</span><br>
                <input type="text" id="dID" name="dID" class="textbox" placeholder="輸入分公司編號"><br>
            </td>
        </tr>
        <tr>
            <td>
                名稱<span style="color: #FF0000">*</span><br>
                <input type="text" id="dName" name="dName" class="textbox" placeholder="輸入分公司名稱"><br>
            </td>
        </tr>
        <tr>
            <td>
                分行英文簡稱<span style="color: #FF0000">*</span><br>
                <input type="text" id="degName" name="degName" class="textbox" placeholder="例:TP"><br>
            </td>
        </tr>
        <tr>
            <td>
                班表類型<span style="color: #FF0000">*</span><br>
                <select name="dtype" id="dtype"  class="select_style" onchange="showDiv(this)">
                    <option value="">請選擇</option>
                    <option value="t1">兩班制-周休二日制</option>
                    <option value="t2">兩班制-輪班制</option>
                    <option value="t3">三班制-輪班制</option>
                </select>
            </td>
        </tr>

        <tr>
        <!--兩班制-早晚-->

		<td id="s1" style="display:none;position: absolute;">
        
        上班時間<span style="color: #FF0000">*</span><br>
        早<br>
            <input type="time" id="D1" name="D1" class="textbox" value="08:00" style="width:auto"> ~ <input type="time" id="D2" name="D2" class="textbox" value="16:00" style="width:auto">
        <br>
        晚<br>
            <input type="time" id="E1" name="E1" class="textbox" value="16:00" style="width:auto"> ~ <input type="time" id="E2" name="E2" class="textbox" value="00:00" style="width:auto">
    
    <br><br>
        班別所需人力<span style="color: #FF0000">*</span><br>
        早：<input type="text" id="D_epy_num" name="D_epy_num" class="textbox" style="width:30px">人 &nbsp;
        晚：<input type="text" id="E_epy_num" name="E_epy_num" class="textbox" style="width:30px">人 <br>
        <br>
        <input type="submit" name="submit" id="submit" class="submit" value="送出">
  </td>
	
<!--三班制-輪班制-->		
<td id="s2" style="display:none;position:absolute;">

        上班時間<span style="color: #FF0000">*</span><br>
        早<br>
            <input type="time" id="D1" name="D1" class="textbox" value="08:00" style="width:auto"> ~ <input type="time" id="D2" name="D2" class="textbox" value="16:00" style="width:auto">
        <br>
        晚<br>
            <input type="time" id="E1" name="E1" class="textbox" value="16:00" style="width:auto"> ~ <input type="time" id="E2" name="E2" class="textbox" value="00:00" style="width:auto">
        <br>
        大夜<br>
            <input type="time" id="N1" name="N1" class="textbox" value="00:00" style="width:auto"> ~ <input type="time" id="N2" name="N2" class="textbox" value="08:00" style="width:auto">
    
    <br><br>
        班別所需人力<span style="color: #FF0000">*</span><br>
        早：<input type="text" id="D_epy_num" name="D_epy_num" class="textbox" style="width:30px">人 &nbsp;
        晚：<input type="text" id="E_epy_num" name="E_epy_num" class="textbox" style="width:30px">人 &nbsp; 
        大夜：<input type="text" id="N_epy_num" name="N_epy_num" class="textbox" style="width:30px">人<br>
        <br>
        <input type="submit" name="submit" id="submit" class="submit" value="送出">
  </td>

  </tr>

    </table>
</form>
</div>


<script type="text/javascript">
  function showDiv(select)
{
	if(select.value=="t1" || select.value=="t2"){
    	document.getElementById('s1').style.display = "block";
	}else{
		document.getElementById('s1').style.display = "none";
	}
	
	if(select.value=="t3"){
    	document.getElementById('s2').style.display = "block";
	}else{
		document.getElementById('s2').style.display = "none";
	}
}
</script>