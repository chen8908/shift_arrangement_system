<!DOCTYPE html>

<link  rel="icon" type="image/png" href="../images/logo2.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/main2.css">
  <!--浮動視窗-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
include("conn.php");



@$eID_left = $_COOKIE['lgid'];
/*SQL*/

@$sql_B_left=mysqli_query($conn,"select * from leader where eID='".$eID_left."'");
@$info_B_left=mysqli_fetch_array($sql_B_left);

if($info_B_left == true) {

  /*高階主管資訊 */
  @$sql_B_cookie = mysqli_query($conn, "select * from leader where eID='".$eID_left."'");
  @$info_B_cookie = mysqli_fetch_array($sql_B_cookie);

  @$privilege_left = $info_B_cookie['privilege'];
  @$eName_left = $info_B_cookie['eName'];

}
else{

  /*登入者員工資訊 */
  @$sql_cookie = mysqli_query($conn, "select * from employee where eID='" . $eID_left . "'");
  @$info_cookie = mysqli_fetch_array($sql_cookie);
  /*登入者分店資訊 */
  @$sql_dp_cookie = mysqli_query($conn, "select * from department where dID='" . $info_cookie['dID'] . "'");
  @$info_dp_cookie = mysqli_fetch_array($sql_dp_cookie);

  @$privilege_left = $info_cookie['privilege'];
  @$eName_left = $info_cookie['eName'];
  @$dID_left = $info_cookie['dID'];
  @$dName_left = $info_dp_cookie['dName'];
}

?>

<?php
if (isset($_COOKIE["lgid"]) && isset($_COOKIE["lgpwd"])) {
} else {
  echo "<script>alert('閒置逾時，請重新登入 !');window.location='login.php';</script>";
}
?>

<body style="font-family: Verdana,sans-serif;background-color:#eeeeee;">
<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:270px;display: none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
  <div class="left">
    <a href="roster.php">
      <div class="left_top">
        <img style="height: 50px; width:50px" src="../images/tick-mark.png" alt="">
        <strong>我的班表</strong>
      </div>
    </a>


    <!-- 搜尋
    <div class="left_select">
      <img style="height: 40px; width: 40px;" src="../images/magnifier.png" alt="">
      <input type="text" id="cuid" name="cuid" class="textbox" placeholder="搜尋關鍵字...">
    </div> -->

    <!-- 薪資 -->
    <a href="leave.php">
      <div class="left_group" style="top: 90px;">
        <img style="height: 40px; width:40px" src="../images/clipboard.png" alt="">
        <strong>線上假單</strong>
      </div>
    </a>

    <!-- 薪資 -->
    <a href="pay.php">
      <div class="left_money">
        <img style="height: 40px; width:40px" src="../images/saving.png" alt="">
        <strong>員工薪資紀錄</strong>
      </div>
    </a>

    <!-- 員工群組 -->
    <?php
    if ($privilege_left == "N") {
      echo '<div style="display:none">';
    }
    ?>

    <a href="epy_group.php">
      <div class="left_group">
        <img style="height: 40px; width:40px" src="../images/call-center.png" alt="">
        <strong>建立員工群組</strong>
      </div>
    </a>
    <?php
    if ($privilege_left == "N") {
      echo '</div>';
    }
    ?>

    <!-- 高階主管群 -->
        <?php
    if ($privilege_left == "N" | $privilege_left == "Y") {
      echo '<div style="display:none">';
    }
    ?>

    <a href="leader.php">
      <div class="left_group" style="top: 270px;">
        <img style="height: 40px; width:40px" src="../images/man.png" alt="">
        <strong>高階主管群</strong>
      </div>
    </a>
    <?php
    if ($privilege_left == "N" | $privilege_left == "Y") {
      echo '</div>';
    }
    ?>

    <!-- 新建班表 -->
    <?php
    if ($privilege_left == "N") {
      echo '<div style="display:none">';
    }
    ?>
    <div class="left_bt">
      <button class="bt1" onclick="location.href='set1.php'"><b>+ 新建班表</b></button>
    </div>
    <?php
    if ($privilege_left == "N") {
      echo '</div>';
    }
    ?>



    <!--<div class="left_user_bk">
	  <a href=""></a><img style="height: 35px;width:35px;" src="../images/setting.png" alt=""></a>
		<a href=""><img style="height: 37px; width: 37px" src="../images/help.png" alt=""></a>
	  </div>


	  
	<div class="left_user_type">
		<ul><b>用戶身分 : <?php
                  /*if ($privilege_left == "Y") {
                echo "中階主管";
            } 
            elseif($privilege_B_left == "B"){
                echo "高階主管";
            }
            else echo "一般職員";*/
                  ?></b></ul>
		<ul><b>目前用戶 : <?php /*echo $eName_left*/ ?></b></ul>
	  </div>-->

    <!--使用者資訊 Start-->
    <div class="left_user_bk2">

      <div class="left_user_bk2_type"><b>用戶身分 : 
        <?php
          if ($privilege_left == "Y") {
            echo "中階主管";
          } elseif ($privilege_left == "B") {
            echo "高階主管";
          } else echo "一般職員";
          ?></b><br><b>目前用戶 : <?php echo $eName_left ?> </b></div>
      <div class="left_user_bk2_fun">
        <div class="left_user_bk2_show">
          <a href="" style="color: #62757f;"  data-toggle="modal" data-target="#myModal" >
            <div>登出</div>
          </a>
          <hr style="margin: 0;border-top: 1px solid darkgrey;">
          <a href="person_edit.php" style="color: #62757f;">
            <div>修改個人資訊
            </div>
          </a>
        </div>
        <img style="height: 35px;width:35px;" src="../images/setting.png" alt="">
        <a href="help.php"><img style="height: 37px; width: 37px" src="../images/help.png" alt=""></a>
      </div>
    </div>
    <!--使用者資訊 End-->

  </div>

   </div>
 <!--content End -->
    <!-- 登出浮動視窗Modal End-->
</div>
    
<div id="main">


  <div class="w3-main" style="position: fixed; width: 100%">
    <div class="w3-blue-grey">
      <button class="w3-button w3-blue-grey w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
    </div>
  </div>
  <!--content Start
	<div class="content">
        <p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p>
        <p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p>
        <p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p>
        <p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p>
        <p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p><p>contain</p>
    </div>
	content End -->
  
    <!-- Modal Start-->
    <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                  class="sr-only">Close</span></button>
              <h3 class="modal-title" id="exampleModalLabel">登出使用者</h3>
            </div>
            <div class="modal-body">
              確定登出使用者嗎?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">否</button>
              <button type="button" class="btn btn-primary" onclick="location.href='logout.php'">確定</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal End-->



</div>

<script>
  function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
  }

  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
  }
</script>