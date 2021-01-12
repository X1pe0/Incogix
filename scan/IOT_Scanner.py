from netaddr import iter_iprange
from scapy.all import *

## Do not make thread limit more then the IP range. ##
thread_limit = 100
## IP Range ##
IP_range_Start = "1.0.0.0"
IP_range_Stop = "255.255.255.255"
## UDP/TCP Port Range ##
port_range_start = "0"
port_range_stop = "9000"
threadLock = threading.Lock()
with threadLock:
    # Supporting non-standard addresses is probably not necessary, revise as needed
    generator = iter_iprange(IP_range_Start, IP_range_Stop, step=1)


def scanit(num):
    for ips in generator:
        print('Worker: %s Scanning - %s' % (num, ips))
        response = os.system("ping -w 1 -c 1 " + str(ips) + " > scan.log")

        if response == 0:
            if not os.path.exists((str(ips)) + ".html"):
                stdout = subprocess.getoutput(
                    "nmap --max-rtt-timeout 2 --max-scan-delay 1 --max-retries 1 --version-intensity 0 -sV --script=banner,vuln -sU -sT -p%s-%s --min-rate 100000 -oX - " % (
                        port_range_start, port_range_stop) + str(ips))
                with open(str(ips) + ".scan", 'w') as f:
                    f.write(stdout)
                stdout = subprocess.getoutput("xsltproc %s.scan -o %s.html" % (ips, ips))
                os.system("cp %s.scan ./raw/%s.scan_raw.txt" % (ips, ips))
                os.system("rm %s.scan" % (ips))
            else:
                pass

        else:
            pass


threads = []

for i in range(thread_limit):
    t = threading.Thread(target=scanit, args=(i,))
    threads.append(t)
    t.start()
