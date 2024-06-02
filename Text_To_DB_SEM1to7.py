# -*- coding: utf-8 -*-
"""
Created on Tue Feb 16 09:46:36 2021
"""

import io
from pdfminer.pdfinterp import PDFResourceManager, PDFPageInterpreter
from pdfminer.converter import TextConverter
from pdfminer.layout import LAParams
from pdfminer.pdfpage import PDFPage
from io import StringIO
import re
import string
import mysql.connector
from mysql.connector import Error
from collections import deque
import sys


def convert_pdf_to_txt(path):
    rsrcmgr = PDFResourceManager()
    retstr = StringIO()
    codec = 'utf-8'
    laparams = LAParams()
    device = TextConverter(rsrcmgr, retstr, codec=codec, laparams=laparams)
    fp = open(path, 'rb')
    interpreter = PDFPageInterpreter(rsrcmgr, device)
    password = ""
    maxpages = 0
    caching = True
    pagenos=set()

    for page in PDFPage.get_pages(fp, pagenos, maxpages=0, password=password,caching=caching, check_extractable=True):
        interpreter.process_page(page)

    text = retstr.getvalue()

    fp.close()
    device.close()
    retstr.close()
    return text

txt=convert_pdf_to_txt('file\\'+"1T00727.pdf")
f=open(r'text\sample.txt','w+',encoding='utf-8')
f.write(txt)
f.close()

try:
    connection = mysql.connector.connect(host='localhost',database='result_analysis',user='root',password='')
    cursor = connection.cursor(buffered=True)
    sql1="""select * from e_detaiils"""
    cursor.execute(sql1)
    rec = cursor.fetchall()   
except mysql.connector.Error as error:
        print("Failed to get record from MySQL table: {}".format(error))            
finally:
        if (connection.is_connected()):
            cursor.close()
            connection.close()
            print("MySQL connection is closed")


#Section Extracting and Data Transformation
file=open(r'text\sample.txt','r')
file1=open(r'text\sample4.txt','w+',encoding='utf-8')
j,k=1000000,0
LRL=len(file.readlines())
file.seek(0)
t,LL,i=0,[],0
line=file.readlines()
while(i<LRL):
    if (re.search(r'428.*D *M *C *E',line[i]) is not None):
      while(re.search(r'FEMALE',line[i]) is None):
        LL.append(line[i])
        i = i+1
      LL.append(line[i])
    else:
        i = i+1
i=0
for line in LL:
    if line.count('-')>100:
        k=k+1
    L2=line.split(" ")
    for i in L2:
        if (i.isdigit() and len(i)==int(rec[0][10])) or (re.search(r'FEMALE',i) is not None) or (i[:int(rec[0][10])].isdigit() and i[int(rec[0][10]):int(rec[0][10])+1]=='/'):
            file1.write('$'+'QWE'+str(j)+" ")
            file1.write(line.upper())
            j=j+1
            k=k+1
    if k==0:
        file1.write(line.upper())
    k=0
    L2.clear()
file1.close()


#fil=open(r'C:\Users\REKHA PARMAR\Documents\FE_2017-18\FE\2017_Nov\sample4.txt','r',encoding='utf-8')
#u4=fil.read()
#N,z,u3=[[]],0,fil.read()
#for i in res:
#    if i[len(i)-1]=='X':
#        Y=eval("re.compile(r'({0}\d\d)')".format(i[:len(i)-2]))
#        for mat in Y.finditer(u4):
#            N[z].append(mat.group(1))
#        z=z+1
#        N.append([])
#N.pop()
#print(N)

cd=[]
try:
    connection = mysql.connector.connect(host='localhost',database='result_analysis',user='root',password='')
    cursor = connection.cursor(buffered=True)
    sql1="""select C_ID, SEQUENCE from course_info where SEM=%s and BRANCH=%s and GRADE_SYSTEM=%s"""
    val1=([int(rec[0][6]),rec[0][4],rec[0][9]])
    cursor.execute(sql1,val1)
    record = cursor.fetchall()
    res=[i[0] for i in list(sorted(record, key=lambda x:x[1]))]
    for i in range(len(res)):
        sql_select_query = """select  THEORY_MARKS, IA_MARKS, THEORY_CREDIT, TW_MARKS, PRACT_MARKS, ORAL_MARKS, TW_PRACT_ORAL_CREDIT from course_info where C_ID = %s and BRANCH=%s"""
        val=(res[i],rec[0][4])
        cursor.execute(sql_select_query,val)
        record = cursor.fetchall()
        for x in record:
            cd.append(x)
    print(cd)
    cid=[]
    for x in range(len(cd)):
        cid.append([])
        for i in range(len(cd[x])):
           if cd[x][i] and type(cd[x][i])==int:
             cid[x].append(cd[x][i])
    print(cid)
    # Track Course data
#     sem, branch, r_v, ex_year, ex_pr, Current_Year='','','','','',''
#     for n,i in enumerate(res):
#         query="INSERT INTO course_info2(C_I, K_I, sem, branch, r_v, ex_year, ex_pr, Current_Year) VALUES(%s,%s,%s,%s,%s,%s,%s,%s) "
#         tup=(i,n+1,sem, branch, r_v, ex_year, ex_pr, Current_Year)
#         cursor.execute(query,tup)

    #Filtering the header
    L=[]
    file=open(r'text\sample4.txt','r')
    for match in re.compile(r'SEAT[\s\S]*\$QWE1000000').finditer(file.read()) :
        Y=match.group(0)
        for mat in re.compile(r'(\d{1,3}/ +\d{1,3})|(\d{1,3} +\/\d{1,3})|(C +\* *GP?)|(C *\* +GP?)').finditer(Y):
            Y=Y.replace(mat.group(0),"".join(mat.group(0).split(" ")))
        for mat in re.compile(r'(\d{1,3}/\d{1,3})|(C\*GP?)|(\n)').finditer(Y):
                L.append(mat.group(0))
        while('\n' in L[0]):
            L.pop(0)
        while('\n' in L[len(L)-1]):
            L.pop(len(L)-1) 
        i=1
        while(i<len(L)):
             if ((L[i-1]=="C*GP" or L[i-1]=="C*G") and L[i]!='|'):
                 L.insert(i,'|')
             i=i+1
        if '|' != L[len(L)-1]:
            L.insert(len(L),'|')
        i=0
        while(i<len(L)):
             if L[i]=="\n" and L[i+1]=="\n":
                L.pop(i)
             i=i+1
        i=0
        while(i<len(L)):        
            for mat in re.compile(r'C\*GP?').finditer(L[i]):
                L[i]=L[i].replace(mat.group(0),'')
            i=i+1
        while('' in L):
            L.remove('')
    file.close()
    print(L)


    #Processing Each student data
    def grade(mo,to):
      if mo=='--':
            return 0
      if mo=='A':
            return 'F'
      else:
         mo=int(mo)
         percent=round((mo*100)/to,2)
         if percent < 40 :
            if re.search(r'\*|\@|P *\!|\#',A) is not None:
               return 'P'
            else:
               return 'F'
         if (45 > percent > 36):
            return 'P' 
         if (50 > percent > 44):
            return 'E' 
         if (60 > percent > 49):
            return 'D'
         if (70 > percent > 59):
            return 'C'
         if (75 > percent > 69):
            return 'B'
         if (80 > percent > 74):
            return 'A'
         if (percent > 79):
            return 'O'
    def point(mo,to):
      if mo=='--':
            return 0
      if mo=='A':
            return 'F'
      else:
         mo=int(mo)
         percent=round((mo*100)/to,2)
         if percent < 40 :
            if re.search(r'\*|\@|P *\!|\#',A) is not None:
               return '4'
            else:
               return '0'
         if (45 > percent > 39):
            return  '4'
         if (50 > percent > 44):
            return '5' 
         if (60 > percent > 49):
            return '6'
         if (70 > percent > 59):
            return '7'
         if (75 > percent > 69):
            return '8'
         if (80 > percent > 74):
            return '9'
         if (percent > 79):
            return '10'
    fil=open(r'text\sample4.txt','r',encoding='utf-8')
    u3=fil.read()
    fil.seek(0)
    RL=fil.readlines()
    z=1000000
    while (z<j):
        s1,c,s2,c1="",0,"",0
        pattern=eval("re.compile(r'\$QWE{0}([\s\S]*)\$QWE{1}')".format(z,z+1))
        y5=pattern.finditer(u3)
        for match in y5:
            A=match.group(1).upper()
            if re.search(r'FEMALE', A) is not None:
                break
            else:
                if re.search(r'\d +\d *E?F?\+? *\(',A) is not None:
                    for op in re.findall(r'\d +\d *E?F?\+? *\(',A):
                        A=A.replace(op,"".join(op.split()))
                while(c<len(A)):
                    if (A[c]=='('): 
                       while(A[c] !=')'):
                         if (A[c] =='('):
                           s1=s1+" "
                         else:
                           s1=s1+''     
                         c=c+1
                    else:
                       s1=s1+A[c]
                    c=c+1
                for i in range(len(s1)):
                    if s1[i]!=' ' or s1[i+1]!=' ' or s1[i+2]!=' ' or s1[i+3]!=' ':
                        s2=s2+s1[i]
                    else:
                        break
                s1=s1.replace(s2,'')
                s1=s1.replace('+','')
                s1=s1.replace('*','')
                s1=s1.replace('!','')
                while re.findall(r'@ *[0-9]{1,}',s1):
                   s1=s1.replace(re.findall(r'@ *[0-9]{1,}',s1)[0],'')
                s1=s1.replace('@','')
                s1=s1.replace('RR','')
                s1=s1.replace('ADC','')
                s1=s1.replace('RPV','')
                s1=s1.replace('RCC','')
                s1=s1.replace('NULL','')
                s1=s1.replace(':','')
                for match in re.compile(r'( (A|P|F) +[A-Z]{2,3}( +[A-Z]{2,5})?)').finditer(s1):
                    s1=s1.replace(match.group(1),'')
                for mat in re.compile(r'\d{1,2}\. +\d{1,3}').finditer(s1):
                    s1=s1.replace(mat.group(0),"".join(mat.group(0).split(" ")))
                L1=s1.split(" ")
                while('' in L1):
                    L1.remove('')
                i=0
                while(i<len(L1)):
                    if L1[i]=='\n':
                        L1[i]=L1[i].replace(L1[i],'|')
                    i=i+1
                i=0
                while(i<len(L1)):
                    if '|' in L1[i]:
                        o=L1.pop(i)
                        o=o.rpartition('|')
                        for v in range (len(o)):
                            L1.insert(v+i,o[v])
                        i=i+2
                    else:
                        i=i+1
                while('' in L1):
                    L1.remove('')
                i=0
                while(i<len(L1)):
                    if (L1[i].isalpha() and len(L1[i])>=3):
                        L1.pop(i)
                    if (L1[i].isdigit() and len(L1[i])>5):
                        L1.pop(i)
                    i=i+1
                i=0
                while(i<len(L1)-2):
                   if ((L1[i]=='|') and (L1[i+1]=='A')):
                        L1[i+1]='$$'
                   i=i+1
                if L1[0]=='A':
                    L1[0]='$$'
                i=0
                while(i<len(L1)-2):
                    if re.search(r'\d\d?',L1[i]) is not None and L1[i+1]=="A":
                        L1[i+1]='$$'
                    i=i+1
                i=0
                while(i<len(L1)-2):
                    if re.search(r'$$',L1[i]) is not None and L1[i+1]=="A":
                        L1[i+1]='$$'
                    i=i+1
                sr=string.ascii_uppercase
                for i in range(len(sr)):
                    h=0
                    while(h<len(L1)):
                      L1[h]=L1[h].replace(sr[i],'')
                      h=h+1
                while('' in L1):
                    L1.remove('')
                while (L1[len(L1)-1]=="|"):
                    L1.pop()    
                i=1
                while(i<len(L1)):
                    while L1[i-1]=='|' and L1[i]=='|':
                        L1.pop(i)
                    i=i+1
                for n,i in enumerate(L1):
                    if re.search(r'\d{1,3}',i) is None and  i!='|' and  i!='$$' and re.search(r'\-{2,4}',i) is None:
                        L1.pop(n)
                while (re.search(r'(\d\d?)|(\$\$)',L1[0]) is None):
                    L1.pop(0)
                d=" ".join(L1)
                L1=(d.replace('$$','A')).split()
                print(L1)
                M=[[]]
                g,h,p,i,y,x=0,0,0,0,0,0
                while(h!=len(L)):
                    if L[h]!='\n':
                        while ((L[h]!='|') and (L[h][:-3] == str(cid[i][g]))) :
                            M[i].append(L1[p])
                            h=h+1
                            p=p+1
                            g=g+1
                            if g==len(cid[i]):
                                break
                        while(L[h]!='|' and h<len(L)):
                                h=h+1
                        h=h+1
                        while(L1[p]!='|' and p<len(L1)-1):
                                p=p+1
                        p=p+1
                        if len(M)>len(cid):
                            break
                        else:
                            if g>len(cid[i])-1:
                                g=0
                                i=i+1
                                if h!=len(L):
                                  M.append([])
                            else:
                              if L[h][:-3]!=str(cid[i][g]):
                                g=0
                                i=i+1
                                if h!=len(L):
                                  M.append([])
                    else:
                        h=h+1
                        while(y!=(len(M)-1)):                        
                            if len(M[y])!=len(cid[y]):
                                while (L[h][:-3]== str(cid[y][len(M[y])+x])) or (L[h][:-2]== str(cid[y][len(M[y])+x])):
                                    M[y].append(L1[p])
                                    x=x+1
                                    h=h+1
                                    p=p+1
                                    if len(M[y])+x>=len(cid[y]):
                                        if len(M[y])+x>len(cid[y]):
                                            break
                                        else:
                                            M[y].append(L1[p])
                                            break
                                while(L[h]!='|' and h<len(L)):
                                    h=h+1
                                h=h+1
                                while(L1[p]!='|' and p<len(L1)-1):
                                    p=p+1
                                p=p+1
                                if len(M[y])==len(cid[y]):
                                    x=0
                            y=y+1
                        if (L[h]=='\n'):
                            h=h+1
                print(M)
                if '/' in s2:
                    gender='F'
                else:
                    gender='M'
                s2=s2.replace('/',' ')
                seat=s2.split()[0]
                print(seat)
                name=s2.replace(seat,'').strip()
                for nop in range(0,len(RL)-1):
                    if (eval("re.search(r'^\$QWE{0} +[0-9]{{1}}',RL[nop])".format(z,rec[0][10])) is not None) and (re.search(r' {4,}(( ? ? ?[A-Z]{1,})+) {3,}[A-Z]{4,}',RL[nop+1]) is not None):
                        name=name+re.findall(r' {4,}(( ? ? ?[A-Z]{1,})+) {3,}[A-Z]{4,}',RL[nop+1])[0][0]
                print(name)
                if len(M)>len(cid):
                    M.pop()                
                print(M)
                tmpname=set(name.split())
                tmpname=list(tmpname)
                tmpname.sort()
                name=" ".join(tmpname)
                tu1=[rec[0][0],rec[0][1],rec[0][2],rec[0][3],rec[0][4],rec[0][5],rec[0][6],rec[0][7],rec[0][8],int(seat),name,gender]
                i=0
                while(i<len(M)):
                    if cd[i][0]==None:
                       tu1.extend([None,None,None,None,None,None,None,None,None])
                    else:
                       tu1.extend([M[i][0], grade(M[i][0],cd[i][0]), 
                                   M[i][1], grade(M[i][1],cd[i][1]),
                                   '-' if M[i][0] == 'A' or M[i][1] == 'A' else int(M[i][0])+int(M[i][1]),cd[i][2],
                                   '-' if M[i][0] == 'A' or M[i][1] == 'A' else grade(int(M[i][0])+int(M[i][1]),cd[i][0]+cd[i][1]),
                                    '-' if M[i][0] == 'A' or M[i][1] == 'A' else point(int(M[i][0])+int(M[i][1]),cd[i][0]+cd[i][1]),
                                   '-' if M[i][0] == 'A' or M[i][1] == 'A' else int(int(point(int(M[i][0])+int(M[i][1]),cd[i][0]+cd[i][1]))*float(cd[i][2]))])
                    if cd[i][3]==None:
                        tu1.extend([None,None])
                    else:
                        if len(M[i])<=2:
                            tu1.extend([M[i][0],grade(M[i][0],cd[i][3])])
                        elif len(M[i])>2:
                            tu1.extend([M[i][2],grade(M[i][2],cd[i][3])])
                    if cd[i][4]==None:
                        tu1.extend([None,None])
                    else:
                        if len(M[i])>3:
                            tu1.extend([M[i][3],grade(M[i][3],cd[i][4])])
                        elif len(M[i])==2:
                            tu1.extend([M[i][1],grade(M[i][1],cd[i][4])])
                        else :
                            tu1.extend([M[i][0],grade(M[i][0],cd[i][4])])
                    if cd[i][5]==None:
                        tu1.extend([None,None])
                    else:
                        if len(M[i])>3:
                            tu1.extend([M[i][3],grade(M[i][3],cd[i][5])])
                        elif len(M[i])==2:
                            tu1.extend([M[i][1],grade(M[i][1],cd[i][5])])
                        else :
                            tu1.extend([M[i][0],grade(M[i][0],cd[i][5])])
                    if cd[i][4]==None and cd[i][5]==None:
                        if len(M[i])>2:
                           tu1.extend([M[i][2], cd[i][6], grade(M[i][2],cd[i][3]), point(M[i][2],cd[i][3]),'-' if M[i][2] =='A' else float(int(point(M[i][2],cd[i][3]))*float(cd[i][6]))])
                        elif len(M[i])==2:
                           tu1.extend([None,None,None,None,None])
                        else:
                           tu1.extend([M[i][0],cd[i][6],grade(M[i][0],cd[i][3]),point(M[i][0],cd[i][3]),'-' if M[i][0] =='A' else float(int(point(M[i][0],cd[i][3]))*float(cd[i][6]))])
                    else:
                        if cd[i][4]!=None and len(M[i])==2:
                            tu1.extend(['-' if M[i][1] == 'A'  else int(M[i][1])+int(M[i][0]),cd[i][6],
                                        '-' if M[i][1] == 'A'  else grade(int(M[i][1])+int(M[i][0]),cd[i][3]+cd[i][4]),
                                        '-' if M[i][1] == 'A'  else point(int(M[i][1])+int(M[i][0]),cd[i][3]+cd[i][4]),
                                        '-' if M[i][1] == 'A'  else float(int(point(int(M[i][1])+int(M[i][0]),cd[i][3]+cd[i][4]))*float(cd[i][6]))])
                        elif cd[i][4]!=None and len(M[i])>3 :
                            tu1.extend(['-' if M[i][2] == 'A' or M[i][3] == 'A' else int(M[i][2])+int(M[i][3]),cd[i][6],
                                        '-' if M[i][2] == 'A' or M[i][3] == 'A' else grade(int(M[i][2])+int(M[i][3]),cd[i][3]+cd[i][4]),
                                        '-' if M[i][2] == 'A' or M[i][3] == 'A' else point(int(M[i][2])+int(M[i][3]),cd[i][3]+cd[i][4]),
                                        '-' if M[i][2] == 'A' or M[i][3] == 'A' else float(int(point(int(M[i][2])+int(M[i][3]),cd[i][3]+cd[i][4]))*float(cd[i][6]))])
                        elif cd[i][4]!=None and len(M[i])==1:
                            tu1.extend(['-' if M[i][0] == 'A'  else int(M[i][0]),cd[i][6],
                                        '-' if M[i][0] == 'A'  else grade(int(M[i][0]),cd[i][4]),
                                        '-' if M[i][0] == 'A'  else point(int(M[i][0]),cd[i][4]),
                                        '-' if M[i][0] == 'A'  else float(int(point(int(M[i][0]),cd[i][4]))*float(cd[i][6]))])    
                        elif cd[i][5]!=None and len(M[i])==2:
                            tu1.extend(['-' if M[i][1] == 'A'  else int(M[i][1])+int(M[i][0]),cd[i][6],
                                        '-' if M[i][1] == 'A'  else grade(int(M[i][1])+int(M[i][0]),cd[i][3]+cd[i][5]),
                                        '-' if M[i][1] == 'A'  else point(int(M[i][1])+int(M[i][0]),cd[i][3]+cd[i][5]),
                                        '-' if M[i][1] == 'A'  else float(int(point(int(M[i][1])+int(M[i][0]),cd[i][3]+cd[i][5]))*float(cd[i][6]))])
                        elif cd[i][5]!=None and len(M[i])==1:
                            tu1.extend(['-' if M[i][0] == 'A'  else int(M[i][0]),cd[i][6],
                                        '-' if M[i][0] == 'A'  else grade(int(M[i][0]),cd[i][5]),
                                        '-' if M[i][0] == 'A'  else point(int(M[i][0]),cd[i][5]),
                                        '-' if M[i][0] == 'A'  else float(int(point(int(M[i][0]),cd[i][5]))*float(cd[i][6]))])                                                      
                        else:
                            tu1.extend(['-' if M[i][2] == 'A' or M[i][3] == 'A' else int(M[i][2])+int(M[i][3]),cd[i][6],
                                        '-' if M[i][2] == 'A' or M[i][3] == 'A' else grade(int(M[i][2])+int(M[i][3]),cd[i][3]+cd[i][5]),
                                        '-' if M[i][2] == 'A' or M[i][3] == 'A' else point(int(M[i][2])+int(M[i][3]),cd[i][3]+cd[i][5]),
                                        '-' if M[i][2] == 'A' or M[i][3] == 'A' else float(int(point(int(M[i][2])+int(M[i][3]),cd[i][3]+cd[i][5]))*int(cd[i][6]))]) 
                    i=i+1
                tu1.extend([L1[len(L1)-3],L1[len(L1)-2],L1[len(L1)-1],'F' if re.search(r'\-',L1[len(L1)-1]) is not None else 'P'])
                print(tu1)
                print(len(tu1))
                i=1
                str8,str9,str10='','','%s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s '
                while(i<len(M)+1):
                   str9=eval("'th{0:0=2d} thg{1:0=2d} ia{2:0=2d} iag{3:0=2d} totth{4:0=2d} crth{5:0=2d} gth{6:0=2d} gpth{7:0=2d} cgpth{8:0=2d} tw{9:0=2d} twg{10:0=2d} pr{11:0=2d} prg{12:0=2d} or{13:0=2d} org{14:0=2d} tottpo{15:0=2d} crtpo{16:0=2d} gtpo{17:0=2d} gptpo{18:0=2d} crgptpo{19:0=2d} '".format(i,i,i,i,i,i,i,i,i,i,i,i,i,i,i,i,i,i,i,i))
                   str8=str8+str9
                   str10=str10+"%s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s " 
                   i=i+1
                str10=",".join(str10.split())
                str9=",".join(str8.split())
                str9=eval("''' INSERT INTO sem_3to6 (schemever,ex_yr,ex_pr,ex_rv,branch,yr,sem,rkp,gzt_st,seat_no,name,m_f,{0},sumc,sumcg,gpa,rslt) VALUES({1})'''".format(str9,str10))
                cursor.execute(str9,tu1)
                connection.commit()
        z=z+1
except mysql.connector.Error as error:
        print("Failed to get record from MySQL table: {}".format(error))            
finally:
        if (connection.is_connected()):
            cursor.close()
            connection.close()
            print("MySQL connection is closed")
fil.close()
