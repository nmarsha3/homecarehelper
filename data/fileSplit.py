#!/usr/bin/env python3


import os
import sys


inFile = sys.argv[1]

numFiles = int(sys.argv[2])

files = list()

for i in range(1,numFiles+1):
   fname = inFile.split('.')[0] + '_' + str(i) + '.txt'
   
   files.append(open(fname, "w"))


with open(inFile, 'r') as inF:
   i = 0
   for line in inF:
      files[i].write(line)
      i += 1
      i %= numFiles
      

