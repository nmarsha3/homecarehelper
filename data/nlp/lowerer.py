#!/usr/bin/env python3

count = 0
with open('training_data_template.txt', 'r') as data, open('fixed.txt', 'w') as fixed:
   for line in data.readlines():
      part1, part2 = line.split('\t')
      part1 = part1.lower()
      fixed.write('\t'.join([part1, part2]))


print(count)
