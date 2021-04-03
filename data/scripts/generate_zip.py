import sys
from random import randint

zips = {}
while len(zips) < 10000:
	num = randint(10000, 99999)
	zips[str(num)] = 1

outfile = open(sys.argv[1], "w+")
for key in zips:
	outfile.write(key)
	outfile.write("\n")

outfile.close()

