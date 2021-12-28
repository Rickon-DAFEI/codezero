import requests
import urllib
import urllib3
from pymysql import *
import re
import io
import sys
from bs4 import BeautifulSoup
import time
import datetime
import codecs
import random
from sshtunnel import SSHTunnelForwarder

origin_url = "http://acm.hdu.edu.cn/showproblem.php?pid="

session = None

res = requests.Session()
head = {"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36","Connection": "keep-alive"}

ssh_host = "47.114.115.244"  # 堡垒机ip地址或主机名
ssh_port = 22  # 堡垒机连接mysql服务器的端口号，一般都是22，必须是数字
ssh_user = "root"  # 这是你在堡垒机上的用户名
ssh_password = "wy@58265208"  # 这是你在堡垒机上的用户密码
mysql_host = "localhost"  # 这是你mysql服务器的主机名或ip地址
mysql_port = 3306  # 这是你mysql服务器上的端口，3306，mysql就是3306，必须是数字
mysql_user = "root"  # 这是你mysql数据库上的用户名
mysql_password = "mysql"  # 这是你mysql数据库的密码
mysql_db = "CodeZero"  # mysql服务器上的数据库名
 
# with SSHTunnelForwarder(
#         (ssh_host, ssh_port),
#         ssh_username=ssh_user,
#         ssh_password=ssh_password,
#         remote_bind_address=(mysql_host, mysql_port)) as server:
# server = SSHTunnelForwarder(ssh_address_or_host=(ssh_host, 22),  # 指定SSH中间登录地址和端口号
#                             ssh_username='root',  # 指定地址B的SSH登录用户名
#                             ssh_password='wy@58265208',  # 指定地址B的SSH登录密码
#                             # local_bind_address=('127.0.0.1', ),  # 绑定本地地址A（默认127.0.0.1）及与B相通的端口（根据网络策略配置，若端口全放，则此行无需配置，使用默认即可）
#                             remote_bind_address=(mysql_host, 3306)  # 指定最终目标C地址，端口号为mysql默认端口号3306
#                             )

# server.start()

print('connect success')
# con = connect(host="127.0.0.1", port=server.local_bind_port, user="root", passwd="mysql", db="CodeZero")
con = connect(host=mysql_host,
                        port=mysql_port,
                        user=mysql_user,
                        passwd=mysql_password,
                        db=mysql_db)
# cs = con.cursor()
cs = con.cursor()
def count_Level(n,subnum):
    flag=0
    if(n>=48):
        flag =  1
    elif(n>=40):
        flag =  2
    elif(n>=37):
        flag= 3
    elif(n>=33):
        flag =  4
    else:
        flag =  5
    if(int(subnum)>100000):
        return 1
    return flag
def main():
    pro_id = 2125
    for i in range(0,7000):
        pro_id+=1
        try:
            mainPage = res.get(origin_url+str(pro_id),headers = head)


            
            bs = BeautifulSoup(mainPage.content,"html.parser")
            # print(bs)
            title = bs.find('h1').text
            sub_main = bs.find_all('font')
            sub_main = sub_main[2].text
            com = re.compile(r'\d+.\d+\s.+?\)')
            lgroup = re.findall(com,sub_main)
            tl = lgroup[0]
            ml = lgroup[1]
            com = re.compile(r'\d+')
            num = re.findall(com,sub_main)
            subNum = num[-2]
            acNum =  num[-1]
            AC_per = round(float(acNum)/float(subNum)*100,2)
            level = count_Level(AC_per,subNum)
            post_data = []
            post_data.append(title)
            post_data.append(tl)
            post_data.append(ml)
            # post_data.append(AC_per)
            # print(sub_main.text)
            data = bs.find_all('div',attrs={'class':'panel_content'})
            for each in data[:3]:
                post_data.append(str(each))
            for each in data[3:5]:
                post_data.append(each.text)
            post_data.append('HDU'+str(pro_id))
            post_data.append('0')
            post_data.append('0')
            post_data.append(str(AC_per))
            post_data.append(str(level))
            try:
                post_data.append(data[5].text)
            except:
                post_data.append('NULL')
            sql = "insert into prolis(title,tlimit,mlimit,pro_des,input,output,sample_input,sample_output,resource,sub_num,solve_num,resource_suc_per,level,remarks) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
            cs.execute(sql,post_data)
            con.commit()
        except:
            print(str(pro_id)+"false")

    con.close()
    cs.close()
    # server.close()
if __name__ == "__main__":
    main()