import os
import MySQLdb

host = "localhost"
username = "root"
password = ""
database = "rankingsda2014"
table = "pagu_sekolah"
dumpdir = "dump/pagu.sql"

conn = MySQLdb.connect(host, username, password, database)

os.system("mysqldump -u%s -p%s %s %s> %s" %(username, password, database, table, dumpdir))
