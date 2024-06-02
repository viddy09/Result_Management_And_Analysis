# -*- coding: utf-8 -*-
"""
Created on Wed Feb 24 21:43:41 2021

@author: REKHAPARMAR
"""

import re
from io import StringIO

import mysql.connector
from pdfminer.converter import TextConverter
from pdfminer.layout import LAParams
from pdfminer.pdfinterp import PDFResourceManager, PDFPageInterpreter
from pdfminer.pdfpage import PDFPage


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
    pagenos = set()

    for page in PDFPage.get_pages(fp, pagenos, maxpages=0, password=password, caching=caching, check_extractable=True):
        interpreter.process_page(page)

    text = retstr.getvalue()

    fp.close()
    device.close()
    retstr.close()
    return text


txt = convert_pdf_to_txt("file\\" + "1T00727.pdf")
f = open(r'text\sample.txt', 'w+', encoding='utf-8')
f.write(txt)
f.close()

try:
    connection = mysql.connector.connect(host='localhost', database='result_analysis', user='root', password='')
    cursor = connection.cursor(buffered=True)
    sql1 = """select * from e_detaiils"""
    cursor.execute(sql1)
    rec = cursor.fetchall()
except mysql.connector.Error as error:
    print("Failed to get record from MySQL table: {}".format(error))
finally:
    if (connection.is_connected()):
        cursor.close()
        connection.close()

# Creating File with Section Separator file Name: sample4.txt
file = open(r'text\sample.txt', 'r')
file1 = open(r'text\sample4.txt', 'w+', encoding='utf-8')
j, k = 1000000, 0
LRL = len(file.readlines())
file.seek(0)
t, LL, i = 0, [], 0
line = file.readlines()
while (i < LRL):
    if (re.search(r'428.*D *M *C *E', line[i]) is not None):
        while (re.search(r'FEMALE', line[i]) is None):
            LL.append(line[i])
            i = i + 1
        LL.append(line[i])
    else:
        i = i + 1
i = 0
for line in LL:
    if line.count('-') > 100:
        k = k + 1
    L2 = line.split(" ")
    for i in L2:
        if (i.isdigit() and len(i) == int(rec[0][10])) or (
                i[:int(rec[0][10])].isdigit() and i[int(rec[0][10]):int(rec[0][10]) + 1] == '/'):
            file1.write('$' + 'QWE' + str(j) + " ")
            file1.write(line.upper())
            j = j + 1
            k = k + 1
    if (re.search(r'SGPI', line) is not None and re.search(r'SEM', line) is not None):
        file1.write('$' + 'QWE' + str(j) + " ")
        file1.write(line.upper())
        j = j + 1
        k = k + 1
    if k == 0:
        file1.write(line.upper())
    k = 0
    L2.clear()
file1.close()

cd = []
try:
    connection = mysql.connector.connect(host='localhost', database='result_analysis', user='root', password='')
    cursor = connection.cursor(buffered=True)
    sql1 = """select C_ID, SEQUENCE from course_info where SEM=%s and BRANCH=%s and GRADE_SYSTEM=%s"""
    val1 = ([int(rec[0][6]), rec[0][4], rec[0][9]])
    cursor.execute(sql1, val1)
    record = cursor.fetchall()
    res = [i[0] for i in list(sorted(record, key=lambda x: x[1]))]
    for i in res:
        sql_select_query = """select  THEORY_MARKS, IA_MARKS, THEORY_CREDIT, TW_MARKS, PRACT_MARKS, ORAL_MARKS, TW_PRACT_ORAL_CREDIT from course_info where C_ID = %s and BRANCH=%s"""
        val = (i, rec[0][4])
        cursor.execute(sql_select_query, val)
        record = cursor.fetchall()
        for x in record:
            cd.append(x)
    print(cd)
    cid = []
    for x in range(len(cd)):
        cid.append([])
        for i in range(len(cd[x])):
            if cd[x][i] and type(cd[x][i]) == int:
                cid[x].append(cd[x][i])
    print(cid)
    # Track Course data
    #     sem, branch, r_v, ex_year, ex_pr, Current_Year='','','','','',''
    #     for n,i in enumerate(res):
    #         query="INSERT INTO course_info2(C_I, K_I, sem, branch, r_v, ex_year, ex_pr, Current_Year) VALUES(%s,%s,%s,%s,%s,%s,%s,%s) "
    #         tup=(i,n+1,sem, branch, r_v, ex_year, ex_pr, Current_Year)
    #         cursor.execute(query,tup)

    L = []
    file = open(r'text\sample4.txt', 'r')
    for match in re.compile(r'SEAT[\s\S]*\$QWE1000000').finditer(file.read()):
        Y = match.group(0).upper()
        for mat in re.compile(r'(\d{1,3}/ +\d{1,3})|(\d{1,3} +\/\d{1,3})').finditer(Y):
            Y = Y.replace(mat.group(0), "".join(mat.group(0).split(" ")))
        for mat in re.compile(r'(\d{1,3}/\d{1,3})').finditer(Y):
            L.append(mat.group(0))
    print(L)


    # Processing Each student data
    def grade(mo, to):
        if mo == '--':
            return 0
        if mo == 'A':
            return 'F'
        else:
            mo = int(mo)
            percent = round((mo * 100) / to, 2)
            if percent < 40:
                if re.search(r'\*|\@|P *\!|\#', A) is not None:
                    return 'P'
                else:
                    return 'F'
            if (45 > percent > 39):
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


    def point(mo, to):
        if mo == '--':
            return 0
        if mo == 'A':
            return 'F'
        else:
            mo = int(mo)
            percent = round((mo * 100) / to, 2)
            if percent < 40:
                if re.search(r'\*|\@|P *\!|\#', A) is not None:
                    return '4'
                else:
                    return '0'
            if (45 > percent > 39):
                return 4
            if (50 > percent > 44):
                return 5
            if (60 > percent > 49):
                return 6
            if (70 > percent > 59):
                return 7
            if (75 > percent > 69):
                return 8
            if (80 > percent > 74):
                return 9
            if (percent > 79):
                return 10


    fil = open(r'text\sample4.txt', 'r', encoding='utf-8')
    u3 = fil.read()
    z = 1000000
    while (z < j):
        s1, c, s2, c1 = "", 0, "", 0
        pattern = eval("re.compile(r'\$QWE{0}([\s\S]*)\$QWE{1}')".format(z, z + 1))
        y5 = pattern.finditer(u3)
        for match in y5:
            A = match.group(1)
        while (c < len(A)):
            if (A[c] == '('):
                while (A[c] != ')'):
                    if (A[c] == '('):
                        s1 = s1 + " "
                    else:
                        s1 = s1 + ''
                    c = c + 1
            else:
                s1 = s1 + A[c]
                c = c + 1
        for i in range(len(s1)):
            if s1[i] != ' ' or s1[i + 1] != ' ' or s1[i + 2] != ' ' or s1[i + 3] != ' ':
                s2 = s2 + s1[i]
            else:
                break
        s1 = s1.replace(s2, '')
        s1 = s1.replace('E', '')
        s1 = s1.replace('F', '')
        s1 = s1.replace('+', '')
        for mat in re.compile(r'((P|F) +([A-Z]{2,5})? +\d{2,3})').finditer(s1):
            s1 = s1.replace(mat.group(1), '')
        for mat in re.compile(r'\d{1,2}\. +\d{1,3}').finditer(s1):
            s1 = s1.replace(mat.group(0), "".join(mat.group(0).split(" ")))
        s1 = s1.split(" ")
        while ('' in s1):
            s1.remove('')
        while ('\n' in s1[0]):
            s1.pop(0)
        while ('\n' in s1[len(s1) - 1]):
            s1.pop(len(s1) - 1)
        i = 0
        while i < len(s1):
            if 'A' == s1[i]:
                s1[i] = '$$'
            i = i + 1
        for n, i in enumerate(s1):
            if re.search(r'\d{2,3}', i) is None and re.search(r'\-{2,4}', i) is None and i != '$$' and i != '\n':
                s1.pop(n)
        while (re.search(r'(\d\d?)|(\$\$)', s1[0]) is None):
            s1.pop(0)
        d = " ".join(s1)
        s1 = (d.replace('$$', 'A')).split()
        M = [[]]
        print(s1)
        h, i, g = 0, 0, 0
        while (h != len(L)):
            if (len(M[i]) != len(cid[i])):
                M[i].append(int(s1[h]))
                h = h + 1
            if g != len(cid) - 1:
                g = g + 1
                M.append([])
            i = (i + 1) % len(cid)
        print(M)
        if '/' in s2:
            gender = 'F'
        else:
            gender = 'M'
        s2 = s2.replace('/', ' ')
        seat = s2.split()[0]
        name = s2.replace(seat, '')
        #        if len(name.split(" "))==3:
        #                 q1="""select GR_NO, Branch, Division from tablestud where Candidate_Name Like %s and Candidate_Name Like %s and (Candidate_Name Like %s or Father_Name Like %s) """
        #                 cursor.execute(q1,('%'+(name.split(" ")[0])+'%','%'+(name.split(" ")[1])+'%','%'+(name.split(" ")[2])+'%','%'+(name.split(" ")[2])+'%'))
        #                 record=cursor.fetchone()
        #        elif len(name.split(" "))==3:
        #                 q1="""select GR_NO, Branch, Division from tablestud where Candidate_Name Like %s and Candidate_Name Like %s and Father_Name Like %s and Mother_Name Like %s """
        #                 cursor.execute(q1,('%'+(name.split(" ")[0])+'%','%'+(name.split(" ")[1])+'%','%'+(name.split(" ")[2])+'%','%'+(name.split(" ")[3])+'%'))
        #                 record=cursor.fetchone()
        z = z + 2
        if len(M) > len(cid):
            M.pop()
        tmpname = set(name.split())
        tmpname = list(tmpname)
        tmpname.sort()
        name = " ".join(tmpname)
        print(seat)
        print(name)
        tu1 = [rec[0][0], rec[0][1], rec[0][2], rec[0][3], rec[0][4], rec[0][5], rec[0][6], rec[0][7], rec[0][8],
               int(seat), name.strip(), gender]
        i = 0
        while (i < len(M)):
            if cd[i][0] == None:
                tu1.extend([None, None, None, None, None, None, None, None, None])
            else:
                tu1.extend([M[i][0], grade(M[i][0], cd[i][0]),
                            M[i][1], grade(M[i][1], cd[i][1]),
                            '-' if M[i][0] == 'A' or M[i][1] == 'A' else int(M[i][0]) + int(M[i][1]), int(cd[i][2]),
                            '-' if M[i][0] == 'A' or M[i][1] == 'A' else grade(int(M[i][0]) + int(M[i][1]),
                                                                               cd[i][0] + cd[i][1]),
                            '-' if M[i][0] == 'A' or M[i][1] == 'A' else point(int(M[i][0]) + int(M[i][1]),
                                                                               cd[i][0] + cd[i][1]),
                            '-' if M[i][0] == 'A' or M[i][1] == 'A' else int(
                                int(point(int(M[i][0]) + int(M[i][1]), cd[i][0] + cd[i][1])) * float(cd[i][2]))])
            if cd[i][3] == None:
                tu1.extend([None, None])
            else:
                if len(M[i]) <= 2:
                    tu1.extend([M[i][0], grade(M[i][0], cd[i][3])])
                elif len(M[i]) > 2:
                    tu1.extend([M[i][2], grade(M[i][2], cd[i][3])])
            if cd[i][4] == None:
                tu1.extend([None, None])
            else:
                if len(M[i]) > 3:
                    tu1.extend([M[i][3], grade(M[i][3], cd[i][4])])
                elif len(M[i]) == 2:
                    tu1.extend([M[i][1], grade(M[i][1], cd[i][4])])
                else:
                    tu1.extend([M[i][0], grade(M[i][0], cd[i][4])])
            if cd[i][5] == None:
                tu1.extend([None, None])
            else:
                if len(M[i]) > 3:
                    tu1.extend([M[i][3], grade(M[i][3], cd[i][5])])
                elif len(M[i]) == 2:
                    tu1.extend([M[i][1], grade(M[i][1], cd[i][5])])
                else:
                    tu1.extend([M[i][0], grade(M[i][0], cd[i][5])])
            if cd[i][4] == None and cd[i][5] == None:
                if len(M[i]) > 2:
                    tu1.extend([M[i][2], cd[i][6], grade(M[i][2], cd[i][3]), point(M[i][2], cd[i][3]),
                                '-' if M[i][2] == 'A' else float(int(point(M[i][2], cd[i][3])) * float(cd[i][6]))])
                elif len(M[i]) == 2:
                    tu1.extend([None, None, None, None, None])
                else:
                    tu1.extend([M[i][0], cd[i][6], grade(M[i][0], cd[i][3]), point(M[i][0], cd[i][3]),
                                '-' if M[i][0] == 'A' else float(int(point(M[i][0], cd[i][3])) * float(cd[i][6]))])
            else:
                if cd[i][4] != None and len(M[i]) == 2:
                    tu1.extend(['-' if M[i][1] == 'A' else int(M[i][1]) + int(M[i][0]), int(cd[i][6]),
                                '-' if M[i][1] == 'A' else grade(int(M[i][1]) + int(M[i][0]), cd[i][3] + cd[i][4]),
                                '-' if M[i][1] == 'A' else point(int(M[i][1]) + int(M[i][0]), cd[i][3] + cd[i][4]),
                                '-' if M[i][1] == 'A' else float(
                                    int(point(int(M[i][1]) + int(M[i][0]), cd[i][3] + cd[i][4])) * float(cd[i][6]))])
                elif cd[i][4] != None and len(M[i]) > 3:
                    tu1.extend(['-' if M[i][2] == 'A' or M[i][3] == 'A' else int(M[i][2]) + int(M[i][3]), int(cd[i][6]),
                                '-' if M[i][2] == 'A' or M[i][3] == 'A' else grade(int(M[i][2]) + int(M[i][3]),
                                                                                   cd[i][3] + cd[i][4]),
                                '-' if M[i][2] == 'A' or M[i][3] == 'A' else point(int(M[i][2]) + int(M[i][3]),
                                                                                   cd[i][3] + cd[i][4]),
                                '-' if M[i][2] == 'A' or M[i][3] == 'A' else float(
                                    int(point(int(M[i][2]) + int(M[i][3]), cd[i][3] + cd[i][4])) * float(cd[i][6]))])
                elif cd[i][4] != None and len(M[i]) == 1:
                    tu1.extend(['-' if M[i][0] == 'A' else int(M[i][0]), int(cd[i][6]),
                                '-' if M[i][0] == 'A' else grade(int(M[i][0]), cd[i][4]),
                                '-' if M[i][0] == 'A' else point(int(M[i][0]), cd[i][4]),
                                '-' if M[i][0] == 'A' else float(int(point(int(M[i][0]), cd[i][4])) * float(cd[i][6]))])
                elif cd[i][5] != None and len(M[i]) == 2:
                    tu1.extend(['-' if M[i][1] == 'A' else int(M[i][1]) + int(M[i][0]), int(cd[i][6]),
                                '-' if M[i][1] == 'A' else grade(int(M[i][1]) + int(M[i][0]), cd[i][3] + cd[i][5]),
                                '-' if M[i][1] == 'A' else point(int(M[i][1]) + int(M[i][0]), cd[i][3] + cd[i][5]),
                                '-' if M[i][1] == 'A' else float(
                                    int(point(int(M[i][1]) + int(M[i][0]), cd[i][3] + cd[i][5])) * float(cd[i][6]))])
                elif cd[i][5] != None and len(M[i]) == 1:
                    tu1.extend(['-' if M[i][0] == 'A' else int(M[i][0]), int(cd[i][6]),
                                '-' if M[i][0] == 'A' else grade(int(M[i][0]), cd[i][5]),
                                '-' if M[i][0] == 'A' else point(int(M[i][0]), cd[i][5]),
                                '-' if M[i][0] == 'A' else float(int(point(int(M[i][0]), cd[i][5])) * float(cd[i][6]))])
                else:
                    tu1.extend(['-' if M[i][2] == 'A' or M[i][3] == 'A' else int(M[i][2]) + int(M[i][3]), int(cd[i][6]),
                                '-' if M[i][2] == 'A' or M[i][3] == 'A' else grade(int(M[i][2]) + int(M[i][3]),
                                                                                   cd[i][3] + cd[i][5]),
                                '-' if M[i][2] == 'A' or M[i][3] == 'A' else point(int(M[i][2]) + int(M[i][3]),
                                                                                   cd[i][3] + cd[i][5]),
                                '-' if M[i][2] == 'A' or M[i][3] == 'A' else float(
                                    int(point(int(M[i][2]) + int(M[i][3]), cd[i][3] + cd[i][5])) * int(cd[i][6]))])
            i = i + 1
        tu1.extend([int(s1[len(s1) - 3]), int(s1[len(s1) - 2]), s1[len(s1) - 1],
                    'F' if re.search(r'\-', s1[len(s1) - 1]) is not None else 'P'])
        i = 1
        str8, str9, str10 = '', '', '%s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s '
        while (i < len(M) + 1):
            str9 = eval(
                "'th{0:0=2d} thg{1:0=2d} ia{2:0=2d} iag{3:0=2d} totth{4:0=2d} crth{5:0=2d} gth{6:0=2d} gpth{7:0=2d} cgpth{8:0=2d} tw{9:0=2d} twg{10:0=2d} pr{11:0=2d} prg{12:0=2d} or{13:0=2d} org{14:0=2d} tottpo{15:0=2d} crtpo{16:0=2d} gtpo{17:0=2d} gptpo{18:0=2d} crgptpo{19:0=2d} '".format(
                    i, i, i, i, i, i, i, i, i, i, i, i, i, i, i, i, i, i, i, i))
            str8 = str8 + str9
            str10 = str10 + "%s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s %s "
            i = i + 1
        str10 = ",".join(str10.split())
        str9 = ",".join(str8.split())
        str9 = eval(
            "''' INSERT INTO sem_3to6 (schemever,ex_yr,ex_pr,ex_rv,branch,yr,sem,rkp,gzt_st,seat_no,name,m_f,{0},sumc,sumcg,gpa,rslt) VALUES({1})'''".format(
                str9, str10))
        cursor.execute(str9, tu1)
        connection.commit()
except mysql.connector.Error as error:
    print("Failed to get record from MySQL table: {}".format(error))
finally:
    if (connection.is_connected()):
        cursor.close()
        connection.close()
