import sys
from random import randint

phones = {}
while len(phones) < 300000:
	num = randint(1000000000, 9999999999)
	if num not in phones:
		phones[str(num)] = 1

outfile = open(sys.argv[1], "w+")
for key in phones:
	outfile.write(key)
	outfile.write("\n")

outfile.close()

