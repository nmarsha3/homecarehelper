import sys
import datetime
import random

dates = {}
start_date = datetime.date(2015, 5, 4)
end_date = datetime.date(2021, 4, 4)
range = end_date - start_date

while len(dates) < 1000:
	rand_number_days = random.randrange(range.days)
	date = start_date + datetime.timedelta(days=rand_number_days)
	# if date not in dates:
	dates[str(date)] = 1

outfile = open(sys.argv[1], "w+")
for key in dates:
	outfile.write(key)
	outfile.write("\n")

outfile.close()

