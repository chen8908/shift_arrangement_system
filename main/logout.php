<?php

setcookie("lgid","",time()-3600*24);//3600為一小時
setcookie("lgpwd","",time()-3600*24);//*24為一天
sleep(2);
header("Location:login.php");


?>