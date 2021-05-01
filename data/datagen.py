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
   print(f'''Usage: {progname} [CONFIG_FILE]''')
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


   
def generateData(attributes, keys, data, num=100, outfile='output.txt', isPerson=False, saveSSNfile=False, SSNfilename=None, allPeople=False):
   '''Generates new, random data by combining the provided sets of attribute data
         attributes = List of desired attribute columns in final dataset
         keys = List of the attributes that are keys(must be unique)
         data = Dictionary of attribute datasets in format: "attribute" : [data1, data2,...]
         num = How many elements to generate
         outfile = File to write output to'''

   if attributes is None or keys is None or data is None:
      return

   global USED_SSNS

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

   if os.path.exists(outfile):
      os.remove(outfile)

   with open(outfile, 'w') as outFile:

      keyset = set()

      # Generate unique key tuples and use them as keys in a set

      done = False

      # RANDOM approach if we want to avoid only using the first few data points
      if allPeople: # use all SSNs as keys; no random keys
         for ssn in data['ssn']:
            keyset.add((ssn,))
      else:
         iterations = 0

         SAVE_SSN_FILE = None
         if saveSSNfile:
            if os.path.exists(SSNfilename):
               os.remove(SSNfilename)
            SAVE_SSN_FILE = open(SSNfilename, 'w+')

         while not done:
            k = list()

            original_size = len(keyset)

            ssn = None

            for key in keys:
               entry = str(random.choice(data[key]))
               k.append(entry)
               if 'ssn' in key: # Keep a record of any ssns used
                  ssn = entry

            k = tuple(k)
            keyset.add(k)

            if len(keyset) > original_size:
               iterations = 0
               if isPerson:
                  USED_SSNS.write(ssn + '\n')
                  if saveSSNfile:
                     SAVE_SSN_FILE.write(ssn + '\n')
            else:
               iterations += 1 # count how many iterations since last addition

            if len(keyset) >= num or iterations > 1000:
               # quit when enough keys generated or 1000 iterations with no addition
               done = True

      print("\tGenerating", len(keyset), "tuples..")

         
      # Loop through key tuples
      for keyTuple in keyset:
         elem = list(keyTuple)

         # Generate random non-key elements
         for att in attributes:
            if att not in keys:
               if att in data:
                  elem.append(str(random.choice(data[att])))
               else:
                  elem.append("")

         outFile.write('\t'.join(elem) + '\n')

      if saveSSNfile:
         SAVE_SSN_FILE.close()
         

def main():

   # Command line args
   if len(sys.argv) != 2:
      usage(1)

   # Read in configuration
   config = readConfigFile(sys.argv[1])

   # Used SSNS stuff for people
   global USED_SSNS, USED_SSNS_FILE

   # Empty the file if it exists already
   if os.path.exists(USED_SSNS_FILE):
      os.remove(USED_SSNS_FILE)

   USED_SSNS = open(USED_SSNS_FILE, 'w')

   # Loop through configuration file and generate data for each table accordingly
   for t in config['toGenerate']:
      name = t['table_name']

      print(f'Generating data for table "{name}"...')
      data = {}

      if 'People' in name:
         USED_SSNS.close()

      # Read in all needed data
      for i in t['infiles']:
         readDataFile(i['file'], i['attr'], data)


      outfile = t['outfile']

      if 'isPerson' in t:
         isPerson = True
      else:
         isPerson = False
      
      SSNfilename = None
      saveSSNfile = False
      if 'Patient' in name:
         SSNfilename = 'used_patient_ssns.txt'
         saveSSNfile = True
      if 'Doctor' in name:
         SSNfilename = 'used_doctor_ssns.txt'
         saveSSNfile = True
      if 'Nurse' in name:
         SSNfilename = 'used_nurse_ssns.txt'
         saveSSNfile = True
      if 'Caregiver' in name:
         SSNfilename = 'used_caregiver_ssns.txt'
         saveSSNfile = True


      if 'People' in name or 'Phones' in name or 'Works_At' in name:
         allPeople = True
      else:
         allPeople = False


      generateData(t['attributes'], t['keys'], data, t['num'], outfile, isPerson, saveSSNfile, SSNfilename, allPeople)


if __name__ == '__main__':
   main()

# vim: set sts=4 sw=4 ts=8 expandtab ft=python
