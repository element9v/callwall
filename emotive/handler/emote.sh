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

cat admiration.txt ecstasy.txt rage.txt amazement.txt >sum
awk -f sum.awk sum>sum.sum
mult=$(awk '{ total += $1; count++ } END { print int(total *count*.25)}' sum.sum)



for file in admiration.txt ecstasy.txt rage.txt amazement.txt; do {
	val=$(cat $file)
	mult=$(cat sum.sum)
	echo $(( $val * $mult/25)) > $file
}; done



./build.sh

