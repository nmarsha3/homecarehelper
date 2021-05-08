#!/usr/bin/env python3

import sys
import os
import random

def readDataFile(filename, attribute, data):
   '''Reads in an input data file and adds the data vals to the data dict under the specified attribute
         filename = File to read from
         attribute = Name of attribute to add data for
         data = Dict to add data to'''

   if filename is None or attribute is None or data is None:
      return

   print(f'\tReading attribute \"{attribute}\" from \"{filename}\"...')

   data[attribute] = list()

   with open(filename, "r") as inFile:
      for line in inFile:
         data[attribute].append(line.strip())

def main():
   if len(sys.argv) != 3:
      print('Error: invalid args')
      sys.exit(1)

   tempfile = sys.argv[1]
   outfile = sys.argv[2]

   if os.path.exists(outfile):
      os.remove(outfile)

   data = {}
   readDataFile('../data_files/ssns.txt', 'ssn', data)
   readDataFile('../data_files/hospital_names.txt', 'hospital', data)
   readDataFile('../data_files/hospital_names.txt', 'clinic', data)
   readDataFile('../data_files/diagnoses_codes.txt', 'diagnosis_code', data)
   readDataFile('../data_files/procedure_codes.txt', 'procedure_code', data)

   with open(tempfile, 'r') as template, open(outfile, 'w') as output:
      
      for line in template:
         if '(ssn)' in line:
               line = line.replace('(ssn)', str(random.choice(data['ssn'])))
         if '(hospital)' in line:
               line = line.replace('(hospital)', str(random.choice(data['hospital'])))
         if '(clinic)' in line:
               line = line.replace('(clinic)', str(random.choice(data['clinic'])))
         if '(diagnosis_code)' in line:
               line = line.replace('(diagnosis_code)', str(random.choice(data['diagnosis_code'])))
         if '(procedure_code)' in line:
               line = line.replace('(procedure_code)', str(random.choice(data['procedure_code'])))

         output.write(line)

   print('done!')


if __name__ == '__main__':
   main()
