import MySQLdb
import math

host = "localhost"
user = "ranking2015"
passwd = "T4k0kn0R1p45"
db = "rankingsda2015"

db = MySQLdb.connect(host, user, passwd, db)
sql='''
select ID_SEKOLAH, PAGUAWAL, PAGUAWAL-JML_TIDAK_NAIK-JML_PRESTASI-PAGULAIN2 
from pagu_sekolah;
'''

pagu = []
cur = db.cursor()
cur.execute(sql)
for i in cur:
    pagurekom = math.ceil(int(i[1])*.10)
    pagupsb = int(i[2])  # pagupsb = paguawal - tdknaik - prestasi - lain
    pagu.append([pagurekom, pagupsb, i[0]])

sql = '''
update pagu_sekolah set pagurekom=%s, pagupsb=%s where id_sekolah=%s;
'''

cur.executemany(sql, pagu)
db.commit()
db.close()
