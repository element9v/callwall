<?
# write transcriptionText to index.html
DATESTR=date('YmdH-i');
$text = $_POST['transcriptionText'];
$var_str = var_export($text, true);
$var = $var_str\n\n";
file_put_contents($DATESTR+'-msg.txt', $var);
exec('emote.sh',$DATESTR+'-msg.txt');
