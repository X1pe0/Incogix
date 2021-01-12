# Incogix
You ever want your own personal Shodan?

BAM! - Incogix is a skiddish looking tool written in Python3 and PHP. 

You need to apt-get or yum the packages below: 

xsltproc, cowsay, fortune, python3, apache2, php5/7+

# Instructions

Edit the IOT_Scanner.py globals to fit your needs.

Drag and drop the repo into your www/html folder. Open a terminal and run the IOT_Scanner.py. Done!
Start apache and navigate to localhost.

# Info

Still working on it, however it works. Theme will be adjusted. 


![Alt text](https://github.com/X1pe0/Incogix/blob/main/images/Screenshot%20at%202021-01-12%2016-39-46.png "Image")
![Alt text](https://github.com/X1pe0/Incogix/blob/main/images/Screenshot%20at%202021-01-12%2016-40-15.png "Image")
![Alt text](https://github.com/X1pe0/Incogix/blob/main/images/Screenshot%20at%202021-01-12%2016-41-12.png "Image")

## If you come across any errors try the following

if you're getting the error `FileNotFoundError: [Errno 2] No such file or directory: b'liblibc.a'`

Try: `cd /usr/lib/x86_64-linux-gnu/
ln -s -f libc.a liblibc.a`
or `sudo ln -s  /usr/lib/libc.a /usr/lib/liblibc.a`
