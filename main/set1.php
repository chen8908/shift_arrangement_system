<title>SA排班-新建班表</title>

<script language="javascript">
    function chkinput(form) {

        if (form.dID.value == "") {
            alert("請選擇排班店家!");
            return (false);
        }
        if (form.sMonth.value == "") {
            alert("請選擇排班月份!");
            form.sMonth.select();
            return (false);
        }
    }
</script>

<?php
include("roster_left.php");
include("conn.php");
include("privilege_BY.php");
?>
<div class="content" style="margin: 0;">
    <h1 align="center">新建班表</h1>
    <form method="POST" action="set1_chk.php" onSubmit="return chkinput(this)">
        <table align="center">
            <tr>
                &nbsp;
            </tr>
            <tr>
                <td>
                    選擇排班分店<br>
                    <select name="dID" id="dID" class="select_style">

                        <?php
                        #SQL查詢department   
                        $sql = mysqli_query($conn, "select * from department");
                        $info = mysqli_fetch_array($sql);


                        if ($privilege_left === "B") {
                            echo '<option value="">請選擇</option>';
                            do {
                                echo '<option value="' . $info['dID'] . '">' . $info['dName'] . '</option>';
                            } while ($info = mysqli_fetch_array($sql));
                        } else {
                            echo '<option value="' . $dID_left . '">' . $dName_left . '</option>';
                        }
                        ?>

                    </select>
                </td>

            </tr>

            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>選擇排班月份<br><input type="month" id="sMonth" name="sMonth" class="select_style" style="width:auto"></td>
            </tr>
            <tr>
                <td align="right">
                    &nbsp;<br>
                    <input class="next" type="submit" id="submit" name="submit" value="Next➜" style="width:70px;" title="下一步">

                </td>
            </tr>
        </table>
    </form>
</div>