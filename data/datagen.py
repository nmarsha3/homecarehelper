#!/usr/bin/env python3

import os
import sys
import csv
import random

def usage(exit_code=0):
   # TODO: fill this in with real usage info
   progname = os.path.basename(sys.argv[0])
   print(f'''Usage: {progname} [-o FILENAME]
   -o FILENAME    Name of file to write to (default = 'output.txt')
   -f FLAG2       Desc2''')
   sys.exit(exit_code)


def readCSV(filename):
   '''Reads in a specified CSV file and returns the desired attributes from the dataset???
      Expects one row of titles with the names of each attribute column'''
   
   # TODO: make this work, but i think the return value we want is something like:
   #        {"attr1" : [elements], "attr2" [elements], ...}
   with open(filename, 'r') as inFile:
      reader = csv.reader(inFile, delimiter=',')
      headers = next(reader)


   # I think then where this function is called, we'll combine the dict entries into one dict with all the data


   
def generateData(attributes, data, num=100, outfile='output.txt'):
   '''Generates new, random data by combining the provided sets of attribute data
         attributes = List of desired attribute columns in final dataset
         data = Dictionary of attribute datasets in format: "attribute" : [data1, data2,...]
         num = How many elements to generate
         outfile = File to write output to'''

   numGenerated = 0

   with open(outfile, 'w') as outFile:
      # Loop through attributes and generate data
      while numGenerated < num:
         elem = []
         for att in attributes:
            elem.append(str(random.choice(data[att])))

         outFile.write('\t'.join(elem) + '\n')
         
         numGenerated += 1



def main():

   # TODO: parse command line args

   # TODO: Load in data


   # Random test data, but this is the format we're going for:
   attributes = ["SSN", "name", "age", "isSick"]

   data = {
         "name"   : ["charlie", "melissa", "steven", "james", "john", "mary"],
         "age"    : [32, 33, 99, 12, 23, 5, 10, 11, 44, 64, 20, 10, 21],
         "SSN"    : ["123-23-1233","412-22-1111","303-12-4040","202-23-4040", "321-09-8765"],
         "isSick" : [True, False]
         }


   # TODO: generate new random entries
   generateData(attributes, data, 15)

   

if __name__ == '__main__':
   main()

# vim: set sts=4 sw=4 ts=8 expandtab ft=python
