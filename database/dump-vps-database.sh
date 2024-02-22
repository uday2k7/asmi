#!/bin/bash
MDB="vava_nt_insurin"
MUSER="vava_nt_iapp"
MPASS='micESpO8i-rLsTAQI1Lzu$hIJaqozlJ#y0'

# PATH
BASEDIR=$(dirname $(readlink -f "$0"))
FILE="$BASEDIR"/database.sql

# CREATING DATABASE FILE IF NOT EXIST HAVING TIMESTAMP 2 DAY OLDER
if [ ! -e "$FILE" ]; then
  touch -d "2 days ago" "$FILE"
fi

if [ -f "$FILE" ] && [ $(($(date +%s) - $(stat -c %Y $FILE))) -gt 86400 ]
then

  # PATH
  MYSQLDUMP=$(which mysqldump)

  echo "Updating Git repo, please wait ....";
  sleep 5;
  git pull
  echo "--------------------[DONE]------------------";
  sleep 5;

  echo "Dumping VPS database, please wait ....";
  sleep 5;

  # CONFIGURE WHETHER WE WANT FULL OR STRUCTURE OR DATASET ONLY
  $MYSQLDUMP -u${MUSER} -p${MPASS} ${MDB} >"$BASEDIR"/database.sql

  echo "VPS database dumped";
  echo "--------------------[DONE]------------------";
  sleep 5;

  echo "Uploading VPS database, please wait ....";
  sleep 5;
  git add "$BASEDIR"/database.sql
  git commit -m "VPS database"
  git push
  echo "VPS database uploaded";
  echo "--------------------[DONE]------------------";
  sleep 5;

else
  echo "Recently uploaded"
fi
