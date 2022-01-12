<!--Title-->
<title>SA排班-修改員工資訊</title>
<link rel="icon" type="image/png" href="https://i.imgur.com/NVquZaa.png">

<?php
include("conn.php");
include("roster_left.php");

$eID = $_GET["eID"];

#echo $eID;

$sql = mysqli_query($conn, "select * from employee where eID='" . $eID . "'");
$info = mysqli_fetch_array($sql);


?>
<script language="javascript">
    function chkinput(form) {


        if (form.eName.value == "") {
            alert("請輸入員工姓名!");
            form.eName.select();
            return (false);
        }
        if (form.etype.value == "") {
            alert("請選擇職稱!");
            return (false);
        }
        if (form.privilege.value == "") {
            alert("請選擇權限!");
            return (false);
        }
        return (true);
    }

    function chkpassedit(x) {
        var yes = confirm('確定將密碼設為預設嗎?');

        if (yes) {
            location.href = 'epy_edit_pass.php?eID=' + x;
        }
    }
</script>

<div class="content" style="margin:0;">
    <h1 align="center">修改 <?php echo $info['eName'] ?>員工資訊</h1>
    <form method="POST" action="epy_edit_save.php?eID=<?php echo $eID ?>" onSubmit="return chkinput(this)">
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
                <td>
                    員工職稱類型<span style="color: #FF0000">*</span><br>
                    <ul>
                        <li>
                            <?php

                            if ($info['etype'] == 'ft') {
                                echo '<input type="radio" name="etype" id="etype" value="ft" checked>正職<br>';
                            } else echo '<input type="radio" name="etype" id="etype" value="ft">正職<br>';

                            ?>
                            月薪
                            <input type="text" id="mon_rate" name="mon_rate" class="textbox" placeholder="$ ?/month" value="<?php echo $info['mon_rate']; ?>"><br>
                        </li>

                        <li>
                            <?php

                            if ($info['etype'] == 'pt') {
                                echo '<input type="radio" name="etype" id="etype" value="pt" checked>兼職<br>';
                            } else echo '<input type="radio" name="etype" id="etype" value="pt">兼職<br>';

                            ?>

                            時薪
                            <input type="text" id="hor_rate" name="hor_rate" class="textbox" placeholder="$ ?/hour" value="<?php echo $info['hor_rate']; ?>"><br>
                        </li>
                    </ul>

                </td>
            </tr>
            <tr>
                <td>
                    權限設定<span style="color: #FF0000">*</span><br>
                    <?php
                    if ($info['privilege'] == 'Y') {
                        echo '
                    <input type="radio" name="privilege" id="privilege" value="Y" checked>中階主管<br>
                    <input type="radio" name="privilege" id="privilege" value="N">一般職員<br>';
                    } elseif ($info['privilege'] == 'N') {
                        echo '
                    <input type="radio" name="privilege" id="privilege" value="Y">中階主管<br>
                    <input type="radio" name="privilege" id="privilege" value="N" checked>一般職員<br>';
                    }
                    ?>

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

    <table align="center">
        <tr>
            <td>
                密碼

            </td>
            <td>
                <button name="<?php echo $info['eID']; ?>" onclick="chkpassedit(name)">將密碼設為預設</button>
            </td>
        </tr>
        <tr>
            <td colspan="2"><small style="color:red">註:預設密碼與員工編號相同</small></td>
        </tr>
    </table>
</div>