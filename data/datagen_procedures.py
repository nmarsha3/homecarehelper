#!/usr/bin/env python3

import os
import sys
import csv
import json
import random


USED_SSNS = None
USED_SSNS_FILE = 'used_ssns.txt'

def usage(exit_code=0):
   # TODO: fill this in with real usage info
   progname = os.path.basename(sys.argv[0])
   print(f'''Usage: {progname}''')
   sys.exit(exit_code)

def readConfigFile(filename):
   '''Reads in a JSON file specifying what data needs to be generated and with what attributes'''

   if filename is None:
      return

   with open(filename, "r") as inFile:
      data = json.load(inFile)
      return data

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


   
def generateProcedureData(attributes, keys, data, num=100):
   '''Generates new, random procedure data by combining the provided sets of attribute data
         attributes = List of desired attribute columns in final dataset
         keys = List of the attributes that are keys(must be unique)
         data = Dictionary of attribute datasets in format: "attribute" : [data1, data2,...]
         num = How many elements to generate'''

   if attributes is None or keys is None or data is None:
      return


   # Check that attributes and keys exist
   for key in keys:
      if key not in data:
         print('Error: key does not exist in source data:', key)
         return

   for a in attributes:
      if a not in data:
         print('Error: attribute does not exist in source data:', a)
         return

   numGenerated = 0

   outfile1 = 'data_files/patient_procedures.txt'
   outfile2 = 'data_files/performed_procedure.txt'

   if os.path.exists(outfile1):
      os.remove(outfile1)
   if os.path.exists(outfile2):
      os.remove(outfile2)

   with open(outfile1, 'w') as patient_file, open(outfile2, 'w') as performed_file:

      keyset = set()

      # Generate unique key tuples and use them as keys in a set

      done = False

      # RANDOM approach if we want to avoid only using the first few data points
      iterations = 0

      while not done:
         k = list()

         original_size = len(keyset)

         ssn = None

         for key in keys:
            entry = str(random.choice(data[key]))
            k.append(entry)

         k = tuple(k)
         keyset.add(k)

         if len(keyset) > original_size:
            iterations = 0
         else:
            iterations += 1 # count how many iterations since last addition

         if len(keyset) >= num or iterations > 1000:
            # quit when enough keys generated or 1000 iterations with no addition
            done = True

      print("\tGenerating", len(keyset), "tuples..")

         
      # Loop through key tuples
      for keyTuple in keyset:

         elem = list(keyTuple)
         performed_file.write('\t'.join(elem) + '\n')

         elem = elem[1:] # Don't need doctor ssn for this one

         # Generate random non-key elements
         for att in attributes:
            if att not in keys:
               if att in data:
                  elem.append(str(random.choice(data[att])))
               else:
                  elem.append("")

         patient_file.write('\t'.join(elem) + '\n')


def main():

   if len(sys.argv) != 1:
      usage(1)

   # Configuration for procedure data generation
   infiles = {
         'patient_ssn'  : 'used_patient_ssns.txt',
         'doctor_ssn'   : 'used_doctor_ssns.txt',
         'code'         : 'data_files/procedure_codes.txt',
         'date'         : 'data_files/procedure_dates.txt',
         'outcome'      : 'data_files/procedure_outcomes.txt',
         'notes'        : 'data_files/procedure_notes.txt'
         }

   keys = ['doctor_ssn', 'patient_ssn', 'code', 'date']
   attributes = ['outcome', 'notes']
   num = 20000
   
   data = {}

   # Read in data files
   for attr in infiles:
      readDataFile(infiles[attr], attr, data)
      

   generateProcedureData(attributes, keys, data, num)


if __name__ == '__main__':
   main()

# vim: set sts=4 sw=4 ts=8 expandtab ft=python
