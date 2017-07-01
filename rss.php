<?php echo "<?" ?>xml version="1.0" encoding="UTF-8"<?php echo "?>" ?>
<rss version="2.0">
	<channel>
		<title>de | Gone with the Blastwave</title>
		<link>https://blastwave.blackpinguin.de</link>
		<description><![CDATA[Deutsche Übersetzung von www.blastwave-comic.com]]></description>
		<language>de-de</language>
      	<generator>PHP/</generator>
	      	<image>
			<url>https://blastwave.blackpinguin.de/header2.jpg</url>
			<title></title>
			<link>https://blastwave.blackpinguin.de</link>
			<description></description>
		</image>
      	
		
		<?php 
		include_once("/rcl/www/funktionen.php");
		include_once("inhalt/connect.php");
		$time=date('D, d M Y G:i:s O', time());
		echo "\n\t\t<lastBuildDate>$time</lastBuildDate>";
		
		$sqlq1 = "SELECT * FROM `pics` ORDER BY `pic_id` DESC";
		$sqlr1 = mysql_query($sqlq1,$verbindung);
		while($row1 = mysql_fetch_object($sqlr1))
			{
			$caption=$row1->de_caption;
			$filename=$row1->file_name;
			$url=$row1->url;
			$id=$row1->pic_id;
			$publ=date('D, d M Y G:i:s O', strtotime($row1->date));
			$lc=date('D, d M Y G:i:s O', strtotime($row1->last_change));
			echo "\n\n\t\t<item>";
			echo "\n\t\t\t<title><![CDATA[$caption]]></title>";
			echo "\n\t\t\t<description>\n\t\t\t\t<![CDATA[";
			echo "\n\t\t\t\t<img src=\"https://blastwave.blackpinguin.de/de/$filename\" alt=\"Bild: $caption\">";
			echo "\n\t\t\t\t<br>Übersetzung von <a href=\"$url\">www.blastwave-comic.com</a>";
			echo "\n\t\t\t\t]]>\n\t\t\t</description>";
			echo "\n\t\t\t<link>https://blastwave.blackpinguin.de/?n=$id</link>";
			echo "\n\t\t\t<pubDate>$lc</pubDate>";
			echo "\n\t\t</item>";
			}
		?>
		
		
		
	</channel>

</rss>
