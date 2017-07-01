<?php

$n = get('n');
$lang = $rcl->lang;


$sqlquery1 = "SELECT `pic_id` FROM `pics` ";
$sqlresult1 = mysql_query($sqlquery1,$verbindung);
while($row1 = mysql_fetch_object($sqlresult1))
	{
	$max=$row1->pic_id;
	}
if ($n == "" || $n > $max) {$n=$max;}
$see=2;



if ($lang != "de" && $lang != "en") 
{
$lang="de";
}


$sqlquery2 = "SELECT * FROM `pics` WHERE `pic_id` = '$n' ";
$sqlresult2 = mysql_query($sqlquery2,$verbindung);
while($row2 = mysql_fetch_object($sqlresult2))
	{
	if($lang=="de")
		{$capt=$row2->de_caption;}
	else
		{$capt=$row2->en_caption;}
	$width=$row2->width."px";
	$height=$row2->height."px";
	$file=$row2->file_name;
	$url=$row2->url;
	}

echo "<div><div style=\"text-align:left;position:absolute;\"><span style=\"font-size:16pt;\">$capt</span><br>";
if ($lang=="de") {echo "Deutsche Übersetzung von <a href=\"$url\">www.blastwave-comic.com</a>";}
else {echo "German translation of <a href=\"$url\">www.blastwave-comic.com</a>";}
echo "</div> ";




echo " <div style=\"text-align:right;\">";
if ($lang == "de") {echo "<img src=\"de.png\" alt=\"\" class=\"flag\"> <a href=\"?n=$n&amp;lang=en\"><img src=\"en.png\" alt=\"\"></a>";}
else {echo "<a href=\"?n=$n&amp;lang=de\"><img src=\"de.png\" alt=\"\"></a> <img src=\"en.png\" alt=\"\" class=\"flag\">";}
echo "</div>";




echo " <div style=\"text-align:right;\">";
$vr="<a href=\"?n=";
$mtt = "\">";
if(!$rcl->langEqual) $mtt = "&amp;lang=$lang".$mtt;
$nch="</a>";
$rcl->page($max,$see,$n,$vr,$mtt,$nch);
echo "</div></div>";


echo "<div id=\"pic\" style=\"width:$width;height:$height;background-image:url('$lang/$file');\"></div>";



?>
