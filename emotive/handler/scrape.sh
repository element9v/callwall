#!/bin/sh
rm -f index.htm
lynx -dump ${1} >index
./emote.sh index
cat >> scraped.html <<EOF
<table>
<td >${1}</td><tr>
<td align=left><table>
<td background="#00ff00" width=$(cat admiration.txt)>&nbsp;</td>
<td bgcolor="#ffff20" width=$(cat ecstasy.txt)>&nbsp;</td>
<td bgcolor="#ff2020" width=$(cat rage.txt)>&nbsp;</td>
<td bgcolor="#6060ff" width=$(cat amazement.txt)>&nbsp;</td>
</table></td>
<tr>
</table><br>
EOF
