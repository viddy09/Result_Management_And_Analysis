import mysql.connector as sql

import pandas as pd

def getdifference(list_a,list_b):
    return list(set(list_a)-set(list_b))
    
db_connection = sql.connect(host='localhost', database='result_analysis', user='root', password='')

db_cursor = db_connection.cursor()
query=('update logindata set `Candidate_Name`=%s where `Candidate_Name`=%s;')
db_cursor.execute('SELECT `Candidate_Name`,`Father_Name`,`Mother_Name` FROM logindata;')

table_rows = db_cursor.fetchall()

df = pd.DataFrame(table_rows)
for i in df.index: 
    
    lst1=df.at[i,0].split()
    lst2=df.at[i,1].split()
    lst3=df.at[i,2].split()
    lst1=list(set(lst1))
    lst2=list(set(lst2))
    lst3=list(set(lst3))
    if len(lst1)>2:
     if getdifference(lst2,lst1):
        lst2.remove(getdifference(lst2,lst1)[0])
    s=set(lst1+lst2+lst3)
    s=list(s)
    s.sort()
    s=" ".join(s)
    
    db_cursor.execute(query,(s,df.at[i,0]))
db_connection.commit()
db_cursor.close()
db_connection.close()
    