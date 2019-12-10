#!/usr/bin/bash

dir=$(pwd)
assets="$dir/assets"
output="$dir/schema"

schemaspy=schemaspy-6.1.0.jar
jdbc=postgresql-jdbc42.2.9.jar

host=localhost
user=postgres
password=''
database=$1

rm -rf $output
mkdir -p $output

ulimit -n 10000
/usr/bin/java -jar "$assets/$schemaspy" -t pgsql -dp "$assets/$jdbc" -host $host -u $user -p $password -s public -db $database -o "$output" > $assets/schemaspy.log
