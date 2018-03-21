<?php
/**
 * Order by apieye.com
 * @param num 密码的随机最小长度
 * @param num 密码的随机最大长度
 * @param bool 是否使用特殊字符
 */
$bfconfig = Array (
	'sitename' => 'APIEYE',  //此处写你的网站名称，会被作为发件人
	);

$mail = Array (
	'state' => 1,
	'server' => 'smtp.126.com', //此处写smtp服务器地址
	'port' => 25,               //此处写smtp服务器端口
	'auth' => 1,
	'username' => 'test@126.com', //此处写smtp服务器账户,通常是邮箱
	'password' => '123456', //此处写smtp服务器密码
	'charset' => 'gbk', //此处写smtp服务器编码
	'mailfrom' => 'test@126.com' //发件人邮件，通常和username相同
	);
function sendmail($mail_to, $mail_subject, $mail_message) {
	global $mail, $bfconfig;
	date_default_timezone_set('PRC');
	$mail_subject = '=?'.$mail['charset'].'?B?'.base64_encode($mail_subject).'?=';
	$mail_message = chunk_split(base64_encode(preg_replace("/(^|(\r\n))(\.)/", "\1.\3", $mail_message)));
	$headers .= "";
	$headers .= "MIME-Version:1.0\r\n";
	$headers .= "Content-type:text/html\r\n";
	$headers .= "Content-Transfer-Encoding: base64\r\n";
	$headers .= "From: ".$bfconfig['sitename']."<".$mail['mailfrom'].">\r\n";
	$headers .= "Date: ".date("r")."\r\n";
	list($msec, $sec) = explode(" ", microtime());
	$headers .= "Message-ID: <".date("YmdHis", $sec).".".($msec * 1000000).".".$mail['mailfrom'].">\r\n";
	if(!$fp = fsockopen($mail['server'], $mail['port'], $errno, $errstr, 30)) {
		exit("CONNECT - Unable to connect to the SMTP server");
	}
	stream_set_blocking($fp, true);
	$lastmessage = fgets($fp, 512);
	if(substr($lastmessage, 0, 3) != '220') {
		exit("CONNECT - ".$lastmessage);
	}
	fputs($fp, ($mail['auth'] ? 'EHLO' : 'HELO')." befen\r\n");
	$lastmessage = fgets($fp, 512);
	if(substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250) {
		exit("HELO/EHLO - ".$lastmessage);
	}
	while(1) {
		if(substr($lastmessage, 3, 1) != '-' || empty($lastmessage)) {
 			break;
 		}
 		$lastmessage = fgets($fp, 512);
	}
	if($mail['auth']) {
		fputs($fp, "AUTH LOGIN\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 334) {
			exit($lastmessage);
		}
		fputs($fp, base64_encode($mail['username'])."\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 334) {
			exit("AUTH LOGIN - ".$lastmessage);
		}
		fputs($fp, base64_encode($mail['password'])."\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 235) {
			exit("AUTH LOGIN - ".$lastmessage);
		}
		$email_from = $mail['mailfrom'];
	}
	fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
	$lastmessage = fgets($fp, 512);
	if(substr($lastmessage, 0, 3) != 250) {
		fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 250) {
			exit("MAIL FROM - ".$lastmessage);
		}
	}
	foreach(explode(',', $mail_to) as $touser) {
		$touser = trim($touser);
		if($touser) {
			fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser).">\r\n");
			$lastmessage = fgets($fp, 512);
			if(substr($lastmessage, 0, 3) != 250) {
				fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser).">\r\n");
				$lastmessage = fgets($fp, 512);
				exit("RCPT TO - ".$lastmessage);
			}
		}
	}
	fputs($fp, "DATA\r\n");
	$lastmessage = fgets($fp, 512);
	if(substr($lastmessage, 0, 3) != 354) {
		exit("DATA - ".$lastmessage);
	}
	fputs($fp, $headers);
	fputs($fp, "To: ".$mail_to."\r\n");
	fputs($fp, "Subject: $mail_subject\r\n");
	fputs($fp, "\r\n\r\n");
	fputs($fp, "$mail_message\r\n.\r\n");
	$lastmessage = fgets($fp, 512);
	if(substr($lastmessage, 0, 3) != 250) {
		exit("END - ".$lastmessage);
	}
	fputs($fp, "QUIT\r\n");
}
