# Incogix
Skid version of Shodan made in under 24hrs. 

PHP/Python3

Apache2 and or webserver of choice needed.

Still working on it, however it works. 


![Alt text](https://github.com/X1pe0/Incogix/blob/main/22e8f786156c09254133929ffbd0a8e27753a531Capture.PNG "Image")


## If you come across any erros try the following

if you're getting the error `FileNotFoundError: [Errno 2] No such file or directory: b'liblibc.a'`

Try: `cd /usr/lib/x86_64-linux-gnu/
ln -s -f libc.a liblibc.a`
or `sudo ln -s  /usr/lib/libc.a /usr/lib/liblibc.a`
