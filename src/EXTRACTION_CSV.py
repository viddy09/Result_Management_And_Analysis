import pandas as pd
from sqlalchemy import create_engine
import mysql.connector
from mysql.connector import Error
import pandas.io.sql as sql


engine = create_engine('mysql+pymysql://root:''@localhost:3306/result_analysis', echo=False)
#connection = mysql.connector.connect(host='localhost',database='result_analysis',user='root',password='')
#cursor = connection.cursor(buffered=True)
#df1=sql.read_sql("""select * from sem_3to6 where sem=3 or sem=4 or sem=5 or sem=6""",engine)
#cursor.execute("""DELETE FROM sem_3to6 where sem=3 or sem=4 or sem=5 or sem=6""")
try:
    df=pd.read_csv("file/1T00727.xlsx")
    df=pd.DataFrame(df)
    #df = pd.concat([df, df1]).drop_duplicates().reset_index(drop=True)
    df.to_sql(name='sem_3to6',con=engine,index=False, if_exists='append')
    print('CSV File Sucessfully written to Database!!!')
except Exception as e:
    try:
        df3=pd.read_excel("file/1T00727.xlsx")
        df3=pd.DataFrame(df3)
        #df = pd.concat([df, df1]).drop_duplicates().reset_index(drop=True)
        df3.to_sql(name='sem_3to6',con=engine,index=False, if_exists='append')
        print('Excel File Sucessfully written to Database!!!')
    except Exception as e1:
        #print('okay1')
        print(e)
try:
    connection = mysql.connector.connect(host='localhost',database='result_analysis',user='root',password='')
    cursor = connection.cursor(buffered=True)
    #cursor.execute('''CREATE TABLE `contacts_temp` LIKE `sem_3to6`;INSERT INTO `contacts_temp` SELECT * FROM `sem_3to6` GROUP BY schemever,ex_yr,ex_pr,ex_rv,branch,sem,stdid,seat_no,name;DROP TABLE `sem_3to6`;ALTER TABLE `contacts_temp` RENAME TO `sem_3to6`;''',multi=True)
    #cursor.execute('''CREATE TABLE `contacts_temp` LIKE `sem_3to6`;''')
    #cursor.execute('''INSERT INTO `contacts_temp` SELECT * FROM `sem_3to6` GROUP BY schemever,ex_yr,ex_pr,ex_rv,branch,sem,stdid,seat_no,name;''')
    #cursor.execute('''DROP TABLE `sem_3to6`;''')
    #cursor.execute('''ALTER TABLE `contacts_temp` RENAME TO `sem_3to6`;''')
    #cursor.callproc('Dupli')
    sql1='''UPDATE `sem_3to6` SET `branch`=%s WHERE (`branch`=%s OR `branch`=%s);'''
    cursor.execute(sql1,("COMPUTER","CO","CSE"))
    connection.commit()
except mysql.connector.Error as error:
        print("Failed to get record from MySQL table: {}".format(error))            
finally:
        if (connection.is_connected()):
            cursor.close()
            connection.close()
            
