
from math import pi

import pandas as pd
import sys
import mysql.connector
from bokeh.io import output_file, save
from bokeh.palettes import Category20c
from bokeh.plotting import figure
from bokeh.transform import cumsum

output_file("pie.html")
#CREATE DATABASE CONNECTION
if True:
    connection = mysql.connector.connect(host='localhost', database='result_analysis',user='root',password='')
    cursor = connection.cursor(prepared=True)

#GET DATA FROM HTML

sem=sys.argv[1]
branch=sys.argv[2]
year=int(sys.argv[3])
sch=sys.argv[4]

#GET DATA FROM DATABASE

P=[]
i=0
#PLOTTING GRAPH FOR DATA VISUALIZATION
if 1:  
  cursor.execute("""select  count(*) from sem_3to6 where gpa=10 and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s' """%(sem,year,branch,sch))
  o=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where gpa>8.99 and gpa<10 and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s'  """%(sem,year,branch,sch))
  a=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where gpa>7.99 and gpa<9 and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s' """%(sem,year,branch,sch))
  b=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GPA>6.99 and gpa<8 and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s' """%(sem,year,branch,sch))
  c=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GPA>5.99 and gpa<7 and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s' """%(sem,year,branch,sch))
  d=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GPA>4.99 and gpa<6 and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s' """%(sem,year,branch,sch))
  e=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where GPA>3.99 and gpa<5 and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s' """%(sem,year,branch,sch))
  p=cursor.fetchone()
  cursor.execute("""select  count(*) from sem_3to6 where rslt='F' and rkp=1 and ex_rv='R' and SEM='%s' and ex_yr='%d' and BRANCH='%s' and schemever='%s' """%(sem,year,branch,sch))
  f=cursor.fetchone()
x = {
    'O': o[0],
    'A': a[0],
    'B': b[0],
    'C': c[0],
    'D': d[0],
    'E': e[0],
    'P': p[0],
    'F': f[0]

}

data = pd.Series(x).reset_index(name='value').rename(columns={'index':'GRADES'})
data['angle'] = data['value']/data['value'].sum() * 2*pi
data['color'] = Category20c[len(x)]

p = figure(plot_height=350, title="POINTER : SEM"+"-"+sem+"-"+branch+"-"+str(year), toolbar_location=None,
           tools="hover", tooltips="@GRADES: @value", x_range=(-0.5, 1.0))

p.wedge(x=0, y=1, radius=0.4,
        start_angle=cumsum('angle', include_zero=True), end_angle=cumsum('angle'),
        line_color="white", fill_color='color', legend_field='GRADES', source=data)

p.axis.axis_label=None
p.axis.visible=False
p.grid.grid_line_color = None

save(p)