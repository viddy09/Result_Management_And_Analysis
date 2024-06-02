from bokeh.io import output_file, save, reset_output,show
from bokeh.plotting import figure
from bokeh.models import ColumnDataSource, FactorRange
import mysql.connector
import sys
connection = mysql.connector.connect(host='localhost', database='result_analysis',user='root',password='')
cursor = connection.cursor(prepared=True)
sem=int(sys.argv[1])
year=int(sys.argv[3])
branch=str(sys.argv[2])
sch=str(sys.argv[4])
# sem=3
# year=2018
# branch="COMPUTER"
# sch="R-2016"
# tmp=theoryno
# theoryno='gth'+theoryno

#GET DATA FROM DATABASE
CORE_ID=[] 
CORE_NAME=[]

countsO=[]
countsA=[]
countsB=[]
countsC=[]
countsD=[]
countsE=[]
countsP=[]
countsF=[]


arrG=['O','A','B','C','D','E','P','F']
cursor.execute("""select C_NAME from course_info where GRADE_SYSTEM='CBCGS' AND THEORY_MARKS is not NULL AND SEM='%s' and BRANCH='%s'"""%(sem,branch))
result=cursor.fetchall()
for i,x in enumerate(result):
    CORE_NAME.append(x[0].decode())
    theoryno="gth0"+str(i+1)
    cursor.execute("""select  count(*) from sem_3to6 where %s='O' and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s' and schemever='%s' """%(theoryno,sem,year,branch,sch))
    o=cursor.fetchone()
    cursor.execute("""select  count(*) from sem_3to6 where %s='A' and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s' and schemever='%s'"""%(theoryno,sem,year,branch,sch))
    a=cursor.fetchone()
    cursor.execute("""select  count(*) from sem_3to6 where %s='B' and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s' and schemever='%s'"""%(theoryno,sem,year,branch,sch))
    b=cursor.fetchone()
    cursor.execute("""select  count(*) from sem_3to6 where %s='C' and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s'  and schemever='%s'"""%(theoryno,sem,year,branch,sch))
    c=cursor.fetchone()
    cursor.execute("""select  count(*) from sem_3to6 where %s='D' and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s'  and schemever='%s'"""%(theoryno,sem,year,branch,sch))
    d=cursor.fetchone()
    cursor.execute("""select  count(*) from sem_3to6 where %s='E' and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s' and schemever='%s'"""%(theoryno,sem,year,branch,sch))
    e=cursor.fetchone()
    cursor.execute("""select  count(*) from sem_3to6 where %s='P' and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s'  and schemever='%s'"""%(theoryno,sem,year,branch,sch))
    p=cursor.fetchone()
    cursor.execute("""select  count(*) from sem_3to6 where (%s='F' or %s='-') and rkp=1 and ex_rv='R' and sem='%d' and ex_yr='%d' and branch='%s'  and schemever='%s'"""%(theoryno,theoryno,sem,year,branch,sch))
    f=cursor.fetchone()
    countsO.append(o[0])
    countsA.append(a[0])
    countsB.append(b[0])
    countsC.append(c[0])
    countsD.append(d[0])
    countsE.append(e[0])
    countsP.append(p[0])
    countsF.append(f[0])
   
grades = ['O','A','B','C','D','E','P','F']

data={'Theory':CORE_NAME,'O':countsO,'A':countsA,'B':countsB,'C':countsC,'D':countsD,'E':countsE,'P':countsP,'F':countsF}

x = [ (th, gd) for th in CORE_NAME for gd in grades]
counts = sum(zip(data['O'], data['A'], data['B'],data['C'],data['D'],data['E'],data['P'],data['F']), ()) # like an hstack

source = ColumnDataSource(data=dict(x=x, counts=counts))
titleOP="THEORY-WISE COMPARISON [ "+branch+" - "+str(sem)+" - "+str(year)+" ]"
p = figure(x_range=FactorRange(*x), plot_height=600, plot_width=1700, title=titleOP,
           toolbar_location="below")

p.vbar(x='x', top='counts', width=0.9, source=source)

p.y_range.start = 0
p.x_range.range_padding = 0.1
p.xaxis.major_label_orientation = 1
p.xgrid.grid_line_color = None


# p = figure(x_range=grades, plot_height=250, title="Theory "+tmp+" Grade counts",toolbar_location=None, tools="")
# p.vbar(x=grades, top=counts, width=0.9)
# p.xgrid.grid_line_color = None
# p.y_range.start = 0



output_file("bars.html")
save(p)