<?php
require_once '/path/to/vendor/autoload.php';

use Twilio\TwiML\VoiceResponse;

#sessionvar for boxid/dir
#array for datestr recordings

box='1001'

// Use the Twilio PHP SDK to build an XML response
$response = new VoiceResponse();

// If the user entered digits, process their request
$i=0; #? 
if (array_key_exists('Digits', $_POST)) {
    switch ($_POST['Digits']) {
    case 1:
	# play ogm
        $response>play($box+'/ogm.wav');
        break;
    case 2:
	$response = new VoiceResponse();
	$response->box=$box
	$response->record(['transcribe' => 'true',
	  'transcribeCallback' => '/emotive/handler.php']);
        #$response->record($box+'/'+$DATESTR+'wall.wav');
        break;
    case 3:
	#handle sms
	break;
    case 4:
	$i--;
	$response->say($images[$i]); $i++;
	break;
    case 5:
	#play callwall
	#array of datestr wavs
	$path    = $box;
	$files = scandir($path); $total = count($files); $images = array(); for($x = 0; $x <= $total; $x++): if ($files[$x] != '.' && $files[$x] != '..') { $images[] = $files[$x]; } endfor;
	$response->say($images[$i]); $i++;
	break;
    case 6:
	$i++;
	$response->say($images[$i]); $i++;
	break;
    case 7[0-9][0-9][0-9][0-9]:
	box=substr($_POST['Digits'],1,4); #truncate 7
	$response->say('box ' $box);
	break;
    case '#'7[0-9][0-9][0-9][0-9]:
	box=substr($_POST['Digits'],2,4); #truncate #7
        mkdir $box;
	$response->say('password');
	#gather digits/handle
	#if e $box/pass handle compare
	 if $box/pass matches post handle
	  admin=true;
	#else 
	  $response->say('new password');
	  #gather write to $box/pass
	$response->say('record ogm');
	$response->play('beep.wav');
	$response->record($box+'/ogm.wav');
	break;
    case 0: $response->say('callwall menu.  press 1 to hear the box ogm.  2 to record.  3 to page and #3 to page alphanumerically.  during playback, press 4 to go back and 6 to go forward.  5 pauses and resumes playback.  to change to a new box, press 7 and the box number.  #7 creates a new box and sets a password and option to record an ogm. thank you for leaving your message.'); default: $response->say('press 0 for help');
    }
} else {
    $gather = $response->gather(array('numDigits' => 'TIMEOUT'));
    $gather->play('blip.wav');

    // If the user doesn't enter input, loop
    $response->redirect('/voice');
}

// Render the response as XML in reply to the webhook request
header('Content-Type: text/xml');
echo $response;


