#!/usr/bin/python
# -*- coding: utf-8 -*-
"""
Created on Thu May  7 12:25:57 2020

@author: REKHA PARMAR
"""
import sys
import mysql.connector
from bokeh.plotting import *
from bokeh.models import HoverTool
from bokeh.layouts import row 

#CREATE DATABASE CONNECTION
if True:
    connection = mysql.connector.connect(host='localhost', database='result_analysis',user='root',password='')
    cursor = connection.cursor(prepared=True)

#GET DATA FROM HTML

sem=sys.argv[1]
branch=sys.argv[2]
year=int(sys.argv[3])

#GET DATA FROM DATABASE
CORE_ID=[] 
CORE_NAME=[]
arrG=['O','A','B','C','D','E','P','F']
cursor.execute("""select C_ID,C_NAME from course_info where SEM='%s' and BRANCH='%s'"""%(sem,branch))
result=cursor.fetchall()
for x in result:
    CORE_ID.append(x[0].decode())
    CORE_NAME.append(x[1].decode())
P=[]
i=0
#PLOTTING GRAPH FOR DATA VISUALIZATION
for z in CORE_ID:    
  cursor.execute("""select  count(*) from sem_3to6 where gth01='O' and sem='%s' and ex_yr='%d' and branch='%s' """%(sem,year,branch))
  o=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GRADE='A' and SEM='%s' and YEAR='%d' and DEPARTMENT='%s' and C_ID='%s'"""%(sem,year,branch,z))
  a=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GRADE='B' and SEM='%s' and YEAR='%d' and DEPARTMENT='%s' and C_ID='%s'"""%(sem,year,branch,z))
  b=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GRADE='C' and SEM='%s' and YEAR='%d' and DEPARTMENT='%s' and C_ID='%s'"""%(sem,year,branch,z))
  c=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GRADE='D' and SEM='%s' and YEAR='%d' and DEPARTMENT='%s' and C_ID='%s'"""%(sem,year,branch,z))
  d=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GRADE='E' and SEM='%s' and YEAR='%d' and DEPARTMENT='%s' and C_ID='%s'"""%(sem,year,branch,z))
  e=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GRADE='P' and SEM='%s' and YEAR='%d' and DEPARTMENT='%s' and C_ID='%s'"""%(sem,year,branch,z))
  p=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GRADE='F' and SEM='%s' and YEAR='%d' and DEPARTMENT='%s' and C_ID='%s'"""%(sem,year,branch,z))
  f=cursor.fetchone()
  arrC=[o[0],a[0],b[0],c[0],d[0],e[0],p[0],f[0]]
  hover = HoverTool()
  hover.tooltips="""
                    <div><h3>No.Of Students</h3>
                    <div><strong>Count: </strong>@right</div>
                    </div>
    """
  p=figure(
        y_range=arrG,
        title=CORE_NAME[i]+'-GRADES',
        x_axis_label='No.of Students',
        y_axis_label='GRADES', 
#        tools=[hover]
        )
  i+=1  
  p.hbar(       
       arrG,
       right=arrC,
       height=0.4,
       color="SKYBLUE",
       fill_alpha=0.4
       )
  p.add_tools(hover,)
  P.append(p)  

output_file('index.php')
show(row(P))  

