#!/usr/bin/env python
import os
import time
import MySQLdb

#mulai waktu start program
print "============================================================"
print time.ctime()

START = time.time()

host = "localhost"
user = "root"
passwd = ""
db = "viewsda2014"
dir_tujuan = "backup/"
db_view = MySQLdb.connect(host, user, passwd, db)

#mengambil idStatus yg aktif ditampilkan
def ambilIDTabel(tingkatan):
	cur = db_view.cursor()
	sql = "select status_id from status_terima_"+tingkatan+" limit 1"
	cur.execute(sql)
	data = cur.fetchone()
	cur.close()
	return ("2" if data[0]==1 else "1")

def ubahStatus(tingkatan, status_baru):
	cur = db_view.cursor()
	sql = "update status_terima_"+tingkatan+" set status_id = "+status_baru +";"
	print "ubah status : ", sql
	cur.execute(sql)
	cur.close()
	
host_ranking="localhost"
user_ranking= "root"
password_ranking =""
db_ranking ="rankingsda2014"

tingkatan_sekolah = ["smp", "sma", "smk"]

#copy database dari ranking
def copy_db():
	for tingkatan in tingkatan_sekolah :
		id_tabel = ambilIDTabel(tingkatan)
		print "copy terima_"+ tingkatan +"_"+id_tabel+" dari database ranking..."
		os.system("mysqldump -h "+ host_ranking +" -u "+user_ranking+" -p"+password_ranking+" "+db_ranking+" terima_"+tingkatan+"_"+id_tabel+" > "+dir_tujuan+"terima_"+tingkatan+".sql")
		os.system("mysql -u "+user+" -p"+passwd+" -h "+host+" -D "+db+" < "+dir_tujuan +"terima_"+tingkatan+".sql");
	
	print "COPY SELESAI"


if __name__ == "__main__":
	copy_db() #copy db

	#ubah status
	for tingkatan in tingkatan_sekolah :
		ubahStatus(tingkatan, "3 - status_id")
	print "UBAH STATUS SELESAI"




	db_view.commit()
	db_view.close()
	waktu = str(time.time()-START)
	print "WAKTU TOTAL : "+ waktu
