import sys
from random import randint

ssns = {}
while len(ssns) < 100000:
	num = randint(100000000, 999999999)
	if num not in ssns:
		ssns[str(num)] = 1

print(ssns)
outfile = open(sys.argv[1], "w+")
for key in ssns:
	outfile.write(key)
	outfile.write("\n")

outfile.close()

