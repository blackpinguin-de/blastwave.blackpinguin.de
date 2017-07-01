<?php
switch ($site)
{

case "400":
$content="inhalt/400.php";
break;

case "401":
$content="inhalt/401.php";
break;

case "403":
$content="inhalt/403.php";
break;

case "404":
$content="inhalt/404.php";
break;

case "500":
$content="inhalt/500.php";
break;

case "501":
$content="inhalt/501.php";
break;

case "502":
$content="inhalt/502.php";
break;

case "503":
$content="inhalt/503.php";
break;

case "imp":
$content="inhalt/imp.php";
break;

case "pic":
$content="inhalt/pic.php";
break;



default:
$content="inhalt/404.php";
break;
}

include_once($content);

mysql_close($verbindung);
?>
