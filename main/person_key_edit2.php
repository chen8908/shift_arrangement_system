

<!--Title-->
<title>SA排班-修改個人資訊</title>
<link rel="icon" type="image/png" href="https://i.imgur.com/NVquZaa.png">
<link rel="stylesheet" href="../css/main2.css">

<?php 

$eID=$_GET['eID'];

include("conn.php");
include("roster_left.php");
#echo $eID;

$sql = mysqli_query($conn,"select * from employee where eID='" . $eID . "'");
$info = mysqli_fetch_array($sql);

?>
<script language="javascript">

function chkinput(form)
{
  
  
if(form.epw.value=="")
  {
   alert("請輸入新密碼!");
   form.epw.select();
   return(false);
  }
  if(form.epw2.value=="")
  {
   alert("請輸入新密碼!");
   form.epw2.select();
   return(false);
  }
  if(form.epw.value != form.epw2.value)
  {
   alert("再次確認密碼不符!");
   return(false);
  }
 return(true);
}

</script>

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
<h1 align="center">輸入新密碼</h1>
    <form id="form" action="person_key_edit_save.php?eID=<?php echo $eID?>" method="POST" onSubmit="return chkinput(this)">
        <table align="center">
        <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    密碼<br>
                    <input type="password" id="epw" name="epw" class="textbox" placeholder="您的新密碼">

                </td>
            <tr>
                <td>
                    確認密碼<br>
                    <input type="password" id="epw2" name="epw2" class="textbox" placeholder="您的新密碼">

                </td>
            </tr>
                <td align="center">
                    &nbsp;<br>
                    <input class="next" type="submit" id="submit" name="submit" value="✔Done" style="width: 80px;">

                </td>

            </tr>

        </table>
    </form>

</div>