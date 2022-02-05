#!/bin/sh
rm -f index.html
curl -o index.html ${1}
./emote.sh
cat > song.sbg <<EOF
ts: $(cat admiration.txt)0+59/5 $(cat ecstasy.txt)00+4/5 $(cat rage.txt)0+4/50 $(cat amazement.txt)0+4/5

0:00 ts
EOF
