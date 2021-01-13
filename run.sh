#!/bin/bash
trap 'clear; echo oh, I am slain; killall python3; killall nmap;' INT
php -S 0.0.0.0:80 &
python3 ./scan/IOT_Scanner.py &
wait
