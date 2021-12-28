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


mysql_host = "localhost"  # 这是你mysql服务器的主机名或ip地址
mysql_port = 3306  # 这是你mysql服务器上的端口，3306，mysql就是3306，必须是数字
mysql_user = "root"  # 这是你mysql数据库上的用户名
mysql_password = "mysql"  # 这是你mysql数据库的密码
mysql_db = "mybatis"  # mysql服务器上的数据库名
con = connect(host=mysql_host,
                        port=mysql_port,
                        user=mysql_user,
                        passwd=mysql_password,
                        db=mysql_db)
# cs = con.cursor()
cs = con.cursor()

def main():
    id = 3
    for each in range(1,500):
        id+=1
        sql="insert into user(money,lost,username,number,password,realname,card_id) values(0,0,%s,'201808140313','test123','我是测试用户',%s)"
        data=[]
        data.append("test_user"+str(id))
        data.append(str(id))
        cs.execute(sql,data)
        con.commit()
    con.close()
    cs.close()




if __name__ == "__main__":
    main()