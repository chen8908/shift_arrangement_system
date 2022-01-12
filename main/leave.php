<?php

include('roster_left.php');

?>

<title>SA排班-線上假單</title>

<link rel="stylesheet" href="../css/breadcrumb.css">
<div class="content">
    <!--麵包屑-->
    <div>
        <ul class="breadcrumb" style="position: static;margin-left: 0px;margin-top: 10px;">
        <li><a href="roster.php">我的班表</a></li>
            <li>線上假單</li>
        </ul>
    </div>

    <h1>線上假單</h1>

    <?php if ($privilege_left == "N") {echo '<div style="display:none">';}?>
    <a href="https://docs.google.com/spreadsheets/d/1eJvu7vud06ijHxQ8Yb0HiOpTjK41azm7pEAAo-IBfmg/edit?resourcekey#gid=1536138166"  target="_blank" style="color: black;"><button>歷史紀錄</button></a>
    <?php if ($privilege_left == "N") {echo '</div>';}?>

    <!--<small>此功能開發測試中...</small>-->
    <hr style="border-top: 1px solid lightgray;">

    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSd65k3XmHrYarW2kCHd-7wfkGZ594iRm561RrdiKBANphmtEg/viewform?embedded=true" width="540" height="1000" frameborder="0" marginheight="0" marginwidth="0">載入中…</iframe>
</div>