#https://github.com/TwilioDevEd/api-snippets/blob/master/twiml/voice/your-response/your-response-1/your-response-1.6.x.php

<?php
require_once './vendor/autoload.php';
use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();
$response->say('beep');
$response->play('https://api.twilio.com/Cowbell.mp3');

echo $response;

$response = new VoiceResponse();
$gather = $response->gather(['action' => '/process_gather.php',
    'method' => 'GET']);
$gather->say('menu');
$response->redirect('/process_gather.php?Digits=TIMEOUT', ['method' => 'GET']);

echo $response;
