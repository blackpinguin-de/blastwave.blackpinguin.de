<?php
if ($err = mysql_init("localhost", "blastwave", "P/6MKaPjyofJaEjc104J", "blastwave")) {
    die("<!doctype html public '-//W3C//DTD HTML 4.01 Transitional//EN'>\n<html lang='de'>\n<head>\n<title>blastwave.blackpinguin.de</title>\n<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>\n<link rel='icon' href='favicon.ico' type='image/x-icon'>\n<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>\n</head>\n<body>\n<div id='allcontainer'>\n<div id='bannercontainer' style='background-image:url(header.jpg);'>\n</div>\n<div id='maincontainer'>\n<div id='content'>\n<span style='font-size:12pt;'>Keine Verbindung mit MySQL-Datenbank möglich</span>\n<br>\n<br>\n<span style='font-size:8pt;'>\n".$err."\n<br>\n<br>\n<a href='https://blackpinguin.de/imp.html' target='_blank'>Impressum</a>\n</span>\n</div>\n</div>\n</body>\n</html>");
}

$verbindung = $rcl->mysqli();
