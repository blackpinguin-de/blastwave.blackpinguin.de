<?php
include("inhalt/connect.php");
include("../funktionen.php");
include("inhalt/counter.php");
?>


<!doctype html public '-//W3C//DTD HTML 4.01 Strict//DE'>
<html lang='<?php echo $rcl->lang; ?>'>
<head>
<title>de | Gone with the Blastwave</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel='icon' href='favicon.ico' type='image/x-icon'>
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
<link rel="stylesheet" type="text/css" href="blastwave2.css" >
<link rel="alternate" type="application/rss+xml" title="Comic (RSS 2.0)" href="rss.php" >
</head>
<body>

<div id='allcontainer'>

	<div id='bannercontainer'></div>
	<div id='maincontainer'>
		<div id='content'>
			<?php
				$site=get('s');
				if ($site == "") {$site="pic";}
				include("include.php");
			?>
			<br>
			<a href="<?php echo ($rcl->langEqual ? "." : $rcl->lang("?lang=de","?lang=en")); ?>">Comic</a>&nbsp;
			<a href="rss.php">RSS</a>&nbsp;
			<a href="<?php echo "?s=imp".($rcl->langEqual ? "" : $rcl->lang("&amp;lang=de","&amp;lang=en")); ?>">Impressum</a>
		</div>
	</div>
</div>


</body>
</html>
