#import library
import sys
import MySQLdb
import os
#import heapq

#variabel
psNO = 0
psNU = 1
psNTMB = 2
psNTK = 3
peserta = []

host = "localhost"
user = "input2014"
passwd = "54t3P4d4n6Un1"
db = "inputsda2014"
db_ranking = MySQLdb.connect(host, user, passwd, db)

def loadPeserta() :
    sql = "select NO_UJIAN, NUN_ASLI, NTMB, NTK from pendaftar_smk"
    cur = db_ranking.cursor()
    cur.execute(sql)

    for i in cur :
        x = list(i)
        peserta.append(x)
    cur.close()

def updateNT() :
	for i in peserta :
        sql = "UPDATE pendaftar_smk SET NT=round(((NUN_ASLI*2)+(NTMB*2)+(NTK))/5, 2) WHERE no_ujian = '" +i[psNO]+ "';"
        cur = db_ranking.cursor()
        cur.execute(sql)
        cur.close()

loadPeserta()
updateNT()
print "Nilai Terpadu terupdate"
db_ranking.commit()
db_ranking.close()
sys.exit(0)
