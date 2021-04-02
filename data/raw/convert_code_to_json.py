import sys

file = open(sys.argv[2], "w+")

for line in open(sys.argv[1]):
	line = line.replace(' ', '\t', 1)
	print(line)
	file.write(line)

file.close()
