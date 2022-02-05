<?php
require_once '/path/to/vendor/autoload.php';

use Twilio\TwiML\VoiceResponse;

// Use the Twilio PHP SDK to build an XML response
$response = new VoiceResponse();

// If the user entered digits, process their request
if (array_key_exists('Digits', $_POST)) {
    switch ($_POST['Digits']) {
    case 1:
	# play ogm
        $response>play('ogm.wav');
        break;
    case 2:
        $response->record($DATESTR+'wall.wav');
        break;
    default:
        $response->say('press 0 for help');
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
