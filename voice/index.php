<?php
require_once '../vendor/autoload.php';

use Twilio\TwiML\VoiceResponse;

#sessionvar for boxid/dir
#array for datestr recordings

$DATESTR=date('YmdH-i');
$rootdir='/www/aq/wall.awre.app';
$box='1001';
$vmdir=$rootdir.'/'.$box;

// Use the Twilio PHP SDK to build an XML response
$response = new VoiceResponse();

// If the user entered digits, process their request
#if (file_exists($vmdir.'/.nav')) { $i=file_get_contents($vmdir.'.nav'); } else { $i=0; }; fi
$i=0;
#voicemail texts
$files = scandir($vmdir); $total = count($files); $images = array(); for($x = 0; $x <= $total; $x++): if ($files[$x] != '.' && $files[$x] != '..') { $images[] = $files[$x]; } endfor;

if (array_key_exists('Digits', $_POST)) {
    switch ($_POST['Digits']) {
    case "1":
	# play ogm
	$sound=$vmdir.'/ogm.wav';
        $gather->play($sound);
        break;
    case "2":
	$response = new VoiceResponse();
	$response->box=$box;
	$response->record(['transcribe' => 'true',
	  'transcribeCallback' => '/emotive/handler/']);
	#$sound=$vmdir.'/'.$DATESTR.'wall.wav';
	#$response->record($sound);
        break;
    case "3":
	#handle sms
	break;
    case "4":
	$i--;
        $response->say(file_get_contents($vmdir.'/'.$images[$i]));
	$i++;
	file_put_contents($vmdir.'.nav', $i);
	break;
    case "5":
	#play callwall
	#array of datestr wavs
	$response->say(file_get_contents($vmdir.'/'.$images[$i]));
	$i++;
	file_put_contents($vmdir.'.nav', $i);
	break;
    case "6":
#	$i++;
        $response->say(file_get_contents($vmdir.'/'.$images[$i]));
	$i++;
	file_put_contents($vmdir.'.nav', $i);
	break;
    case "7[0-9][0-9][0-9][0-9]":
	$box=substr($_POST['Digits'],1,4); #truncate 7
	$response->say("box $box");
	break;
    case "#7[0-9][0-9][0-9][0-9]":
	$box=substr($_POST['Digits'],2,4); #truncate #7
        mkdir("$box");
	$response->say('password');
	$response->gather(array('numDigits' => '5'));
	$pass = file_get_contents($vmdir.'/pass');
	if ( $pass == $Digits ) { $admin=true; } else {
	  $response->say('new password');
	  $response->gather(array('numDigits' => '5'));
	  $pass=$Digits;
	  $response->say('again');
	  $response->gather(array('numDigits' => '5'));
	  $passcheck=$Digits;
	  if (strcmp($pass,$passcheck)) {
	  file_put_contents('$vmdir/pass', $Digits);
	  } else {
	  $response->say('mismatch');
	  }}
	fi;
	$response->say('record ogm');
	$response->play('beep.wav');
	$response->record($box.'/ogm.wav');
	break;
    case "0":
	    $response->say('callwall menu.  press 1 to hear the box ogm.  2 to record.  3 to page and #3 to page alphanumerically.  during playback, press 4 to go back and 6 to go forward.  5 pauses and resumes playback.  to change to a new box, press 7 and the box number.  #7 creates a new box and sets a password and option to record an ogm. thank you for leaving your message.');
    default:
	    $response->say('press 0 for help');
    }
} else {
    $gather = $response->gather(array('numDigits' => '1'));
    $gather->play('blip.wav');

}
    // If the user doesn't enter input, loop
    $response->redirect('/voice');

// Render the response as XML in reply to the webhook request
header('Content-Type: text/xml');
echo $response;


