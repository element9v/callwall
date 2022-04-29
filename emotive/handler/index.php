<?php
# write transcriptionText to index.html
$DATESTR=date('YmdH-i');
$text = $_POST['TranscriptionText'];
#$box = $_POST['box'];
$box = '1001';
$var_str = var_export($text, true);
$var = $var_str."\n\n";
file_put_contents($DATESTR.'-msg.txt', $var);
#exec('emote.sh',$DATESTR.'-msg.txt');
exec("cp $DATESTR-msg.txt ../../$box/");
