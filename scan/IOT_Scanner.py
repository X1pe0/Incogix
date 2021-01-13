import time
import sys
import os
import subprocess 
from netaddr import iter_iprange
from threading import Thread
import threading
from signal import signal, SIGINT
from sys import exit
def clear():
    if os.name =="nt": 
        os.system("cls")
    else: 
        os.system("clear")
        
def prompt_sudo():
    ret = 0
    if os.geteuid() != 0:
        msg = "[sudo] password for %u:"
        ret = subprocess.check_call("sudo -v -p '%s'" % msg, shell=True)
    return ret
user = os.getenv("SUDO_USER")
if user is None:
    print ("This program need 'sudo'")
    prompt_sudo()
## Do not make thread limit more then the IP range. ##
thread_limit = 5
## IP Range ##
try:
    IP_range_Start = sys.argv[1]
    IP_range_Stop = IP_range_Start
    os.system("rm %s.html"%(IP_range_Start))
    os.system("rm %s.scan"%(IP_range_Start))
    os.system("rm ./raw/%s.scan_raw.txt"%(IP_range_Start))
except:
    IP_range_Start = "127.0.0.1"
    IP_range_Stop = "127.0.0.3"
## UDP/TCP Port Range ##
port_range_start = "0"
port_range_stop = "9000"
threadLock = threading.Lock()
with threadLock:
    generator = iter_iprange(IP_range_Start, IP_range_Stop, step=1)
def scanit(num):
    for ips in generator:
        print ('Worker: %s Scanning - %s'%(num,ips))
        response = os.system("ping -w 1 -c 1 " + str(ips) + " > scan.log")

        if response == 0:
            if not os.path.exists((str(ips))+".html"):
                stdout = subprocess.getoutput("nmap --max-rtt-timeout 2 --max-scan-delay 1 --max-retries 1 --version-intensity 0 -sV --script=banner,vuln -sU -sT -p%s-%s --min-rate 100000 -oX - "%(port_range_start,port_range_stop) + str(ips))
                with open(str(ips)+".scan",'w') as f: f.write(stdout)
                stdout = subprocess.getoutput("xsltproc %s.scan -o %s.html"%(ips,ips))
                os.system("cp %s.scan ./raw/%s.scan_raw.txt"%(ips,ips))
                os.system("rm %s.scan"%(ips))
            else:
                pass

        else:
            pass

threads = []

for i in range(thread_limit):
    clear()
    t = threading.Thread(target=scanit, args=(i,))
    threads.append(t)
    t.start()
