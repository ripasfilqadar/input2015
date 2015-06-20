#import library
import sys
import MySQLdb

host = "localhost"
user = "root"
passwd = "P154n6M3r4h"
db = "viewsda2014"
db_ranking = MySQLdb.connect(host, user, passwd, db)

def doupdate():
    sql = "update status_terima_sma set status_id = 3-status_id"
    cur = db_ranking.cursor()
    cur.execute(sql)
    cur.close()

    sql = "update status_terima_smp set status_id = 3-status_id"
    cur = db_ranking.cursor()
    cur.execute(sql)
    cur.close()

    sql = "update status_terima_smk set status_id = 3-status_id"
    cur = db_ranking.cursor()
    cur.execute(sql)
    cur.close()

doupdate()
db_ranking.commit()
db_ranking.close()
sys.exit(0)
