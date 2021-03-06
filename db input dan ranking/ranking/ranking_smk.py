#import library
import sys
import os
import time
import MySQLdb
#import heapq

START = time.time()

#indeks atribut sekolah
skID = 0
skNAMA = 1
skJUR = 2
skPAGU = 3
skREKOM = 4
#indeks tambahan (kebutuhan sendiri)
skLIST = 5

#indeks atribut peserta
psNO = 0
psNAMA = 1
psTGL = 2
psASAL = 3
psBIND = 4
psMAT = 5
psIPA = 6
psBING = 7
psNTMB = 8
psNTK = 9
psNT = 10
psNUNASLI = 11
psNILAIAKHIR = 12
psPILIH1 = 13
psPILIH2 = 14
psJALUR = 15
#indeks tambahan (kebutuhan sendiri)
psPILIHAN = 16
psDITERIMA = 17
psURUT = 18
psRANK = 19


#variabel pembantu
sekolah = {}
peserta = []
paguTotal = 0

host = "localhost"
user = "ranking2014"
passwd = "54t3P4d4n6Un1"
db = "rankingsda2014"
dir_tujuan = "sql/pendaftar_smp.sql"

#os.system("mysql -u "+user+" -p"+passwd+" -h "+host+" -D "+db+" < "+dir_tujuan);

db_ranking = MySQLdb.connect(host, user, passwd, db)

def copy_data() :
    #copy pendaftar dari komputer input
    host_input="localhost"
    user_input= "input2014"
    password_input = "54t3P4d4n6Un1"
    db_input ="inputsda2014"
    table_input="pendaftar_smk"
    #os.system("mysqldump -h "+ host_input +" -u "+user_input+" -p"+password_input+" "+db_input+" "+table_input+" > "+dir_tujuan);
    os.system("mysqldump -h %s -u%s -p%s %s %s > %s" % (host_input, user_input, password_input, db_input, table_input, dir_tujuan));

def loadSekolah() :
    sql= '''
    SELECT ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN, PAGUPSB, PAGUREKOM
    FROM pagu_sekolah
    WHERE NAMA_SEKOLAH like ('SMK%') ORDER BY ID_SEKOLAH ASC
    '''
    cur = db_ranking.cursor()
    cur.execute(sql)
    global paguTotal

    for i in cur:
            x = list(i) + [[]]      #ditambahkan list peserta diterima
            paguTotal= paguTotal + int(x[skPAGU])
            sekolah[int(x[skID])] = x

    print "pagu SMK total = " + str(paguTotal)
    cur.close()

def loadPeserta() :
    sql = '''
    select NO_UJIAN, NAMA, WAKTU_DAFTAR, ASAL_SEKOLAH, UAN_BIND, UAN_MAT, UAN_IPA, UAN_BING, NTMB, NTK, NILAI_AKHIR as NT, NUN_ASLI, NILAI_AKHIR, PILIH1, PILIH2, JALUR_DAFTAR
    from pendaftar_smk
    order by NT DESC, NUN_ASLI DESC, UAN_BIND DESC, UAN_MAT DESC, UAN_IPA DESC, UAN_BING DESC, WAKTU_DAFTAR ASC
    '''
    cur = db_ranking.cursor()
    cur.execute(sql)

    rank = 0
    for i in cur :
            #x = list(i) + [0,0,-1,-rank]
            x = list(i) + [0,0,-1,rank]
            rank = rank + 1
            peserta.append(x)

    print str(rank) + " peserta SMK diranking"

    cur.close()

def update_pilihan(pst, ids, pilihan):
    global paguTotal
    pst[psPILIHAN]=pilihan
    pst[psDITERIMA] = '%02d' % ids
    sekolah[ids][skLIST].append(pst[psRANK])
    sekolah[ids][skPAGU] = sekolah[ids][skPAGU] - 1
    paguTotal = paguTotal - 1

def isiPagu():
    global paguTotal
    for pst in peserta :
        if paguTotal == 0:
            print "pagu SMK sudah terpenuhi"
            break
        if pst[psPILIHAN]>0:
            continue
        if pst[psPILIH1] != None :
            ids = int(pst[psPILIH1])
            if sekolah.has_key(ids) and sekolah[ids][skPAGU] > 0 :
                if pst[psJALUR][:1] == '2': #akan diubah untuk pengecekan yang terkena pagu 10%
                    if pst[psJALUR][1:2] == '2':
                        if sekolah[ids][skREKOM]>0:
                            sekolah[ids][skREKOM] = sekolah[ids][skREKOM] - 1
                            update_pilihan(pst, ids, 1)
                    else:
                        update_pilihan(pst, ids, 1)
                else:
                    update_pilihan(pst, ids, 1)
        if pst[psPILIHAN]>0:
            continue
        if pst[psPILIH2] != None and pst[psPILIH2].strip()!='':
            ids = int(pst[psPILIH2])
            if sekolah.has_key(ids) and sekolah[ids][skPAGU] > 0 :
                if pst[psJALUR][:1] == '2': #akan diubah untuk pengecekan yang terkena pagu 10%
                    if pst[psJALUR][1:2] == '2':
                        if sekolah[ids][skREKOM]>0:
                            sekolah[ids][skREKOM] = sekolah[ids][skREKOM] - 1
                            update_pilihan(pst, ids, 2)
                    else:
                        update_pilihan(pst, ids, 2)
                else:
                    update_pilihan(pst, ids, 2)

def dump_hasil(tabel):
    def create_table():
        sql = " DROP TABLE IF EXISTS `%s`;" % (tabel, )
        cur = db_ranking.cursor()
        cur.execute(sql)
        sql = '''
            CREATE TABLE `%s` (
              `NO_UJIAN` varchar(15) NOT NULL DEFAULT '',
              `NAMA` varchar(60) NOT NULL DEFAULT '',
              `ASAL_SEKOLAH` varchar(50) NOT NULL DEFAULT '',
              `TGL_LAHIR` date DEFAULT NULL,
              `BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
              `MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
              `IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
              `BING` decimal(8,2) NOT NULL DEFAULT '0.00',
              `NILAI_PSIKOTES` decimal(8,2) NOT NULL DEFAULT '0.00',
              `NILAI_WAWANCARA` decimal(8,2) NOT NULL DEFAULT '0.00',
              `NILAI_TERPADU` decimal(8,2) NOT NULL DEFAULT '0.00',
              `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
              `NILAI_AKHIR` decimal(8,2) DEFAULT '0.00',
              `PILIH1` varchar(10) NOT NULL DEFAULT '',
              `PILIH2` varchar(10) DEFAULT NULL,
              `PILIHAN` tinyint(2) DEFAULT '0',
              `JALUR_DAFTAR` varchar(2) DEFAULT 1,
              `DITERIMA` varchar(10) DEFAULT '0',
              `NO_URUT` int DEFAULT NULL,
              `RANKING` int DEFAULT NULL,
              `NO_CONTROL` varchar(22) DEFAULT NULL,
              `ID_KAWASAN` int(11) NOT NULL DEFAULT '0'
            ) ENGINE=InnoDB
            ''' % (tabel,)
        cur.execute(sql)

    def none_str(o):
        if o==None:
            return '-'
        return o

    create_table()
    sql = '''insert into %s (NO_UJIAN, NAMA, TGL_LAHIR, ASAL_SEKOLAH, BIND, MAT,
    IPA, BING, NILAI_PSIKOTES, NILAI_WAWANCARA, NILAI_TERPADU, NUN_ASLI, NILAI_AKHIR, PILIH1, PILIH2, PILIHAN, JALUR_DAFTAR, DITERIMA,
    NO_URUT, RANKING) ''' % (tabel,) + ''' VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s);'''
    #print sql
    cur = db_ranking.cursor()
    data = []
    ctr = 0
    for pst in peserta:
        ctr = ctr + 1
        data.append((pst[psNO], pst[psNAMA], pst[psTGL], pst[psASAL],
            pst[psBIND], pst[psMAT], pst[psIPA], pst[psBING], pst[psNTMB], pst[psNTK], pst[psNT], pst[psNUNASLI],
            pst[psNILAIAKHIR], pst[psPILIH1], pst[psPILIH2],
            str(pst[psPILIHAN]), pst[psJALUR], str(pst[psDITERIMA]), str(pst[psURUT]),
            abs(pst[psRANK])))
        if ctr == 50:
            cur.executemany(sql, data)
            data = []
            ctr = 0
    cur.executemany(sql, data)

def AmbilNamaTabel():
    db_view = MySQLdb.connect("localhost", "view2014", "54t3P4d4n6Un1", "viewsda2014")
    cur = db_view.cursor()
    sql = "select status_id from status_terima_smk limit 1"
    cur.execute(sql)
    data = cur.fetchone()
    cur.close()
    db_view.close()
    return ("terima_smk_1" if data[0]==2 else "terima_smk_2")

def beri_nomor_urut():
    for skl in sekolah.items():
        urut = map(abs, skl[1][skLIST])
        urut.sort()
        for i in enumerate(urut,1):
            peserta[i[1]][psURUT] = i[0]

if __name__ == '__main__':
    print "==================================================================="
    print time.ctime()
    copy_data()
    os.system("mysql -u%s -p%s -h %s -D %s < %s" % (user, passwd, host, db, dir_tujuan));
    loadPeserta()
    loadSekolah()
    isiPagu()
    beri_nomor_urut()
    tabel = AmbilNamaTabel()
    print "tulis di tabel ", tabel
    dump_hasil(tabel)
    db_ranking.commit()
    db_ranking.close()
    waktu = str(time.time()-START)
    print "RANKING SMK SELESAI\nTOTAL WAKTU : "+ waktu
    sys.exit(0)
