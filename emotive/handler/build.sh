#!/bin/sh
cat > plutchick.html <<EOF
<table>
<td bgcolor="#00ff00" width=$(cat admiration.txt)>
.
<td bgcolor="#ffff20" width=$(cat ecstasy.txt)>
.
<td bgcolor="#ff2020" width=$(cat rage.txt)>
.
<td bgcolor="#6060ff" width=$(cat amazement.txt)>
.
</table>
EOF
