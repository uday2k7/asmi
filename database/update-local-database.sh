#!/bin/bash
MUSER="root"
MPASS="root"
MDB="insurin"

echo "Downloading remote database, please wait ....";
sleep 5;
git pull
echo "--------------------[DONE]------------------";

# Detect paths
MYSQL=$(which mysql)
AWK=$(which awk)
GREP=$(which grep)

echo "Re-creating database $MDB"
sleep 5
$MYSQL -v -u $MUSER -p$MPASS -e " DROP DATABASE $MDB;"
$MYSQL -v -u $MUSER -p$MPASS -e " CREATE DATABASE $MDB;"
echo "--------------------[DONE]------------------";

echo "Updating local database, please wait ....";
sleep 5;
mysql -u${MUSER} -p${MPASS} ${MDB} <database.sql
echo "Latest remote database successfully installed in local machine";
echo "--------------------[DONE]------------------";
sleep 5;
