import sys

outfile = open(sys.argv[2], "w+")

for line in open(sys.argv[1], "r"):
	outfile.write(line.split("\t")[0])
	outfile.write("\n")

outfile.close()

