<?php

date_default_timezone_set("Europe/Berlin");



function mail_from($from, $to, $sbj, $msg)
{
	mb_internal_encoding("UTF-8");
	$subject = mb_encode_mimeheader($sbj, "UTF-8", "B");
	$header = "From: $from";
	//return mail($to, $subject, $msg, $header);
	return 1;
}



function get($value)
    {
    if( !is_string($value) ) { return ""; }
	if( !array_key_exists($value, $_GET) ) {return "";}
    $temp = $_GET[$value];
    if( !is_string($temp) ) { return ""; }
    $temp = mysql_real_escape_string($temp);
    if(!mb_check_encoding($temp, "UTF-8")) $temp = utf8_encode($temp);
    return $temp;
    }



//gets an base64 encoded string
function str64($value)
	{
	$b64 = get($value);
	$text = base64_decode($b64, true);
	check($text !== FALSE);
    if( !is_string($text) ) { return ""; }
    $text = mysql_real_escape_string($text);
    if(!mb_check_encoding($text, "UTF-8")) $text = utf8_encode($text);
	return $text;
	}


function raw_match($value, $pattern)
    {
    if( preg_match( $pattern, $value ) )
        {
        return 1;
        }
    else
        {
        return 0;
        }
    }

function check($cond)
	{
	if(!$cond){die("0");}
	}

function match($value, $pattern)
	{
	check(raw_match($value, $pattern) === 1);
	}







$id = (int) get("id");
check($id > 0 || $id < 500);


$date = get("date");
check(strlen($date) === 19);
match($date, "/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}\ [0-9]{2}:[0-9]{2}:[0-9]{2}$/");


$msg  = "<!doctype html public \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
$msg .= "<html lang=\"de\">\n<head>\n";
$msg .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n";
$msg .= "<title>Unfall App</title>\n";
$msg .= "<style type=\"text/css\"><!-- h4{margin-bottom:0px;} --></style>\n";
$msg .= "</head>\n<body><h3>(ID$id) Unfall vom $date</h3>";



//optional
$udid = get("udid");
if($udid !== ""){
	check(strlen($udid) === 40);
	match($udid, "/^[0-9a-f]{40}$/");
	$msg .= "Handy-UDID: $udid<br/>";
}


//optional
$lat = get("lat");
if($lat !== ""){
	$lat = (float) $lat;
	check($lat > -179.9999 && $lat < 180.0001);
	$msg .= "Handy-Latitude: $lat<br/>";
}


//optional
$lng = get("lng");
if($lng !== ""){
	$lng = (float) $lng;
	check($lng > -179.9999 && $lng < 180.0001);
	$msg .= "Handy-Longitude: $lng<br/>";
}


//IP-Adresse
$ip = $_SERVER["REMOTE_ADDR"];
if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	$ip .= " (f&uuml;r: ".$_SERVER["HTTP_X_FORWARDED_FOR"].")";
}
$msg .= "IP-Adresse: $ip<br/>";

//Uhrzeit
$time = time();
$msg .= "Unfallmeldung empfangen am: ".date("d.m.Y",$time)." um ".date("H:i:s",$time)."<br/>";





$msg .= "<h4>Unfallgegner</h4>";



$gname = str64("gname");
check(0 < strlen($gname));
check(strlen($gname) <= 100);
$msg .= "Name: $gname<br/>";



//optional
$gtel = str64("gtel");
if($gtel !== ""){
	check(strlen($gtel) <= 100);
	$msg .= "Telefon: $gtel<br/>";

}

//optional
$gemail = str64("gemail");
if($gemail !== ""){
	check(strlen($gemail) <= 100);
	$msg .= "E-Mail: $gemail<br/>";
}


$gkennz = str64("gkennz");
check(0 < strlen($gkennz));
check(strlen($gkennz) <= 100);
$msg .= "KFZ-Kennzeichen: $gkennz<br/>";


$gvers = str64("gvers");
check(0 < strlen($gvers));
check(strlen($gvers) <= 100);
$msg .= "KFZ-Versicherung: $gvers<br/>";



// u
$msg .= "<h4>Mandant</h4>";




$uname = str64("uname");
check(0 < strlen($uname));
check(strlen($uname) <= 100);
$msg .= "Name: $uname<br/>";


$utel = str64("utel");
check(0 < strlen($utel));
check(strlen($utel) <= 100);
$msg .= "Telefon: $utel<br/>";


//optional
$uemail = str64("uemail");
if($uemail !== ""){
	check(strlen($uemail) <= 100);
	$msg .= "E-Mail: $uemail<br/>";
}


$ukennz = str64("ukennz");
check(0 < strlen($ukennz));
check(strlen($ukennz) <= 100);
$msg .= "KFZ-Kennzeichen: $ukennz<br/>";



$uvers = str64("uvers");
check(0 < strlen($uvers));
check(strlen($uvers) <= 100);
$msg .= "KFZ-Versicherung: $uvers<br/>";



$hergang = str64("hergang");
check(0 < strlen($hergang));
check(strlen($hergang) <= 3000);
$msg .= "<p>Unfallhergang:<br/>$hergang</p>";



//Optional
$notiz = str64("notiz");
if($notiz !== ""){
	check(strlen($notiz) <= 3000);
	$msg .= "<p>Sonstige Notizen:<br/>$notiz</p>";
}





$from = "iOS-App@domain.tld";
$to = "kunde@domain.tld";
$sbj = "Unfall App: Unfallmeldung von $uname";
$msg .= "</body>\n</html>";
$status = mail_from($from, $to, $sbj, $msg);
if($status){echo "1";}
else{echo "0";}


//echo $msg;
?>
