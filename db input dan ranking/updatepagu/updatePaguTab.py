import sys
import MySQLdb

#atribut sekolah
IDsk = 0
NAMAsk = 1
PAGUAWALsk = 2
TDKNAIKsk = 3
PRESsk = 4

#koneksi ke database
host = "localhost"
user = "ranking2014"
passwd = "54t3P4d4n6Un1"
db = "rankingsda2014"
db_ranking = MySQLdb.connect(host, user, passwd, db)

#variabel yang dibutuhkan
sekolah = {}
temp = []

#===============================================================
def loadSekolah() :
    sql= "SELECT ID_SEKOLAH, NAMA_SEKOLAH, PAGUAWAL, JML_TIDAK_NAIK, JML_PRESTASI FROM pagu_sekolah ORDER BY ID_SEKOLAH ASC"
    cur = db_ranking.cursor()
    cur.execute(sql)

    for i in cur:
        x = list(i)
        sekolah[int(x[IDsk])] = x
#===============================================================
def ceksama(idsekolah, paguawal, tdknaik, prestasi) :
    id = int(idsekolah)
    if sekolah.has_key(id):
        if (sekolah[id][PAGUAWALsk]!=int(paguawal)) | (sekolah[id][TDKNAIKsk]!=int(tdknaik)) | (sekolah[id][PRESsk]!=int(prestasi)):
	    print "ID sekolah :", id
	    print "Nama sekolah :", sekolah[id][NAMAsk]
            print "Data awal :", sekolah[id][PAGUAWALsk], sekolah[id][TDKNAIKsk], sekolah[id][PRESsk]
            print "Data baru :", paguawal, tdknaik, prestasi
            return 1
        else:
            return 0
#===============================================================
def updatePagu(idsekolah, paguawal, tdknaik, prestasi) :
    sql= "UPDATE pagu_sekolah set PAGUAWAL=%s, JML_TIDAK_NAIK=%s, JML_PRESTASI=%s where ID_SEKOLAH=%s" % (paguawal, tdknaik, prestasi, idsekolah)
    cur = db_ranking.cursor()
    cur.execute(sql)
#===============================================================

#Main
#buka file input
openfile = open("input.txt", "r")
loadSekolah()
#id rombel kelas tidaknaik prestasi
for line in openfile:
    #Data dari text dimasukkan ke variabel
    temp = line.split("\t")
    if temp[0] == "ID_SEKOLAH":
        continue
    idsekolah = int(temp[0])
    paguawal = int(temp[1])*int(temp[2])
    tdknaik = int(temp[3])
    prestasi = int(temp[4])
    
    if(ceksama(idsekolah, paguawal, tdknaik, prestasi)):
        x = raw_input("Masukkan perintah ok untuk update pagu : ")
        if(x == "ok"):
            updatePagu(idsekolah, paguawal, tdknaik, prestasi)
            print "Pagu sudah diupdate"
        else:
            print "Pagu tidak diupdate"
            continue

openfile.close()
db_ranking.commit()
db_ranking.close()
sys.exit(0)
