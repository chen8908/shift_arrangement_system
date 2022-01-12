<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="icon" type="image/png" href="../images/logo2.png">
    <title>SA排班-login</title>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script language="javascript">
  function chkinput(form)
  {
    if(form.eID.value=="")
	{
	 alert("請輸入員工編號(帳號)!");
	 form.eID.select();
	 return(false);
	}
	if(form.epw.value=="")
	{
	 alert("請輸入密碼!");
	 form.epw.select();
	 return(false);
	}
    
   return(true);
  }
</script>
    <style>
        .submit {
            background-color: #F7C242;
            /* 黃 */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            width: 200px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 10px;
        }

        .textbox {
            border-radius: 5px;
            width: 300px;
            height: 25px;
        }

    </style>
            
</head>

<body>
<?php
    if(isset($_COOKIE["lgid"]) && isset($_COOKIE["lgpwd"]))
    {
        header("Location:roster.php");
    }
?>
    <header style="text-align: center;padding-top:100px;">
        <a href="../index.html"><img height="200px" width="200px" src="../images/logo2.png"></a>
    </header>

    <h1 align="center">登入</h1>
    <form id="form" action="chk_login.php" method="POST" onSubmit="return chkinput(this)">
        <table align="center">
            <tr>
                <td>
                    ID<br>
                    <input type="text" id="eID" name="eID" class="textbox" placeholder="您的員工編號"><br>
                    
                </td>
            </tr>
            <tr>
                <td>
                    密碼<br>
                    <input type="password" id="epw" name="epw" class="textbox" placeholder="您的密碼">

                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">
                    <input class="submit" type="submit" id="submit" name="submit" value="登入">

                </td>

            </tr>
            <!--
            <tr>
                <td align="center">
                    第一次使用SA排班?
                    <a style="color: #F7C242;" role="button" href="new_member.php">註冊</a>
                </td>
            </tr>-->
        </table>
    </form>
</body>

</html>