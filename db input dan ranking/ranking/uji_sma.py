import MySQLdb

print "UJI SMA.......(kalau tidak diprint, berarti OK)"

host = "localhost"
user = "view2014"
passwd = '54t3P4d4n6Un1'
db = "viewsda2014"
db_view = MySQLdb.connect(host, user, passwd, db)

#mengambil idStatus yg aktif ditampilkan

def ambilIDTabel(tingkatan):
	cur = db_view.cursor()
	sql = "select status_id from status_terima_"+tingkatan+" limit 1"
	cur.execute(sql)
	data = cur.fetchone()
	cur.close()
	return ("2" if data[0]==1 else "1")

print "Uji tabel: ", 'terima_sma_'+ambilIDTabel('sma')

host = "localhost"
user = "ranking2014"
passwd = '54t3P4d4n6Un1'
db = "rankingsda2014"

sql = 'select diterima, max(ranking) from %s where diterima>0 group by diterima;' % ('terima_sma_'+ambilIDTabel('sma'),)

db = MySQLdb.connect(host, user, passwd, db)

cur = db.cursor()
cur.execute(sql)
ranking = {}
for i in cur:
    ranking[i[0]] = i[1]

#sql = '''select no_daftar, pilih1, pilih2, rank, pilihan, diterima from proses_sma_ws where diterima=0'''
sql =  'select NO_UJIAN, PILIH1, PILIH2, RANKING, PILIHAN, DITERIMA, nilai_akhir, jalur_daftar from %s where DITERIMA=0 and JALUR_DAFTAR<>22' % ('terima_sma_'+ambilIDTabel('sma'),)

#    0         1       2      3      4         5
# no_daftar, pilih1, pilih2, rank, pilihan, diterima 
cur = db.cursor()
cur.execute(sql)
for pst in cur:
    if ranking.has_key(pst[1]) and pst[3]<ranking[pst[1]]:
        print pst
    if ranking.has_key(pst[2]) and pst[3]<ranking[pst[2]]:
        print pst
    #else:
    #    print "index tidak ada: ", pst[1], pst[2]

