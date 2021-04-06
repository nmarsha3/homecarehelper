import sys
import json

names = {}

with open(sys.argv[1]) as f:
	names = json.load(f)

outfile = open(sys.argv[2], "w+")
for key in names:
	outfile.write(key)
	outfile.write("\n")

outfile.close()

