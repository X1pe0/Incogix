# Incogix
You ever want your own personal Shodan?

BAM! - Incogix is IoT scanner written in Python3 and PHP. 

You may need to apt-get, yum, dnf, etc.. the packages below: 

xsltproc, cowsay, fortune, python3, php5/7+, nmap

# Instructions

Edit the IOT_Scanner.py globals to fit your needs.

Drag and drop the repo into your www/html folder. Open a terminal and run the IOT_Scanner.py. Done!
Start apache and navigate to localhost.

# Info/To Be Added.

Still working on it, however it works. Theme will be adjusted. 

1. Will be adding recent searches and basic history using browser cookies.
2. Adding a method of staring hosts.
3. Adding the ability to click a button for re-scan of host. - Done
4. Adding "realtime scanning". If the search result is not available; IP will be queued for scanning.
5. Adding additonal information regarding host instead of using nmap -> html parsing. Ex: root folder of /127.0.0.1/ with nmap, golismero, dnsrecon, amass, nikto, and arachni scans parsed into a single webpage. This would allow for subdomain enumeration, CVEs vuln, SSL issues, Possible admin pages, Banners, etc... (This would come with little quirks such as RDP screenshots and host -> enumeration/network traversal via web gui. 


![Alt text](https://github.com/X1pe0/Incogix/blob/main/images/rescan.jpg "Image")
![Alt text](https://github.com/X1pe0/Incogix/blob/main/images/Screenshot%20at%202021-01-12%2016-40-15.png "Image")
![Alt text](https://github.com/X1pe0/Incogix/blob/main/images/Screenshot%20at%202021-01-12%2016-41-12.png "Image")

## If you come across any errors try the following

if you're getting the error `FileNotFoundError: [Errno 2] No such file or directory: b'liblibc.a'`

Try: `cd /usr/lib/x86_64-linux-gnu/
ln -s -f libc.a liblibc.a`
or `sudo ln -s  /usr/lib/libc.a /usr/lib/liblibc.a`
