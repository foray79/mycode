import pymysql

my_db = pymysql.connect(
    user='search',
    passwd='rjator1!',
    host='192.168.0.155',
    db='jason_search',
    charset='utf8'   
)