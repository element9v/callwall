#!/bin/bash
msgfile="${1}"
rm blah
for emote in $(cat ../admiration.txt); do { grep ${emote} $msgfile | wc -l >>blah; }; done
awk -f sum.awk blah > admiration.txt
rm blah
for emote in $(cat ../ecstasy.txt); do { grep ${emote} $msgfile | wc -l>>blah; }; done
awk -f sum.awk blah > ecstasy.txt
rm blah
for emote in $(cat ../rage.txt); do { grep ${emote} $msgfile | wc -l >>blah; }; done
awk -f sum.awk blah > rage.txt
rm blah
for emote in $(cat ../amazement.txt); do { grep ${emote} $msgfile | wc -l>>blah; }; done
awk -f sum.awk blah > amazement.txt
