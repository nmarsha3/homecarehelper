#!/usr/bin/env python3

count = 0
with open('training_data_template.txt', 'r') as data:
   for line in data.readlines():
      if '\t' not in line:
         print(line)
         count += 1

print(count)
