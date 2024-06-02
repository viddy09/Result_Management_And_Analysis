# -*- coding: utf-8 -*-
"""
Created on Fri Apr  2 23:20:44 2021

@author: REKHAPARMAR
"""

from pymysql import*
import xlwt
import pandas.io.sql as sql
import pandas as pd
import sys
import mysql.connector
from mysql.connector import Error

try:
    connection = mysql.connector.connect(host='localhost',database='result_analysis',user='root',password='')
    cursor = connection.cursor(buffered=True)
    sql1="""select ex_yr,ex_pr,ex_rv,branch,yr,sem,rkp from e_detaiils"""
    cursor.execute(sql1)
    rec = cursor.fetchall()
except mysql.connector.Error as error:
        print("Failed to get record from MySQL table: {}".format(error))            
finally:
        if (connection.is_connected()):
            cursor.close()
            connection.close()
# connect the mysql with the python
con=connect(user="root",password="",host="localhost",database="result_analysis")
#sql.read_sql("""Update sem_3to6 where branch=%s or branch=%s""",con,params=['CO','CSE'])
# read the data
df=sql.read_sql("""select * from sem_3to6 where ex_yr=%s and ex_pr=%s and ex_rv=%s and branch=%s and yr=%s and sem=%s and rkp=%s""",con,params=[int(rec[0][0]),int(rec[0][1]),rec[0][2],rec[0][3],rec[0][4],int(rec[0][5]),int(rec[0][6])])
#df=sql.read_sql("""select * from sem_3to6 where branch=%s""",con,params=[rec[0][3]])
#print(df)
xls_name=''
xls_name=rec[0][3]+"-"+rec[0][0]+"_sem"+rec[0][5]+"_"+str(rec[0][2])+".xlsx"
#xls_name=rec[0][3]+"_sem_7(CBSGS)_"+".xlsx"
writer = pd.ExcelWriter(xls_name, engine='xlsxwriter')

# export the data into the excel sheet
df.to_excel(writer, sheet_name='Sheet1', index=False)
writer.save()
print(xls_name)