#!/bin/bash
python /home/ppdb/backup2014/jadi/ranking/ranking_smp.py >> /home/ppdb/backup2014/jadi/ranking/smp.log
python /home/ppdb/backup2014/jadi/ranking/uji_smp.py >> /home/ppdb/backup2014/jadi/ranking/smp.log
python /home/ppdb/backup2014/jadi/ranking/ranking_sma.py >> /home/ppdb/backup2014/jadi/ranking/sma.log
python /home/ppdb/backup2014/jadi/ranking/uji_sma.py >> /home/ppdb/backup2014/jadi/ranking/sma.log
#python /home/ppdb/backup2014/jadi/ranking/updateNT.py >> /home/ppdb/backup2014/jadi/ranking/smk.log
python /home/ppdb/backup2014/jadi/ranking/ranking_smk.py >> /home/ppdb/backup2014/jadi/ranking/smk.log
python /home/ppdb/backup2014/jadi/ranking/uji_smk.py >> /home/ppdb/backup2014/jadi/ranking/smk.log
