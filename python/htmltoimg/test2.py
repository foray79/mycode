#pip install --user selenium==4.1.0
#pip install --user chromedriver-autoinstaller==0.3.1
# exec example python test_htmltoimage.py [lvcm_prgm_sno] -> selenium 12052
from selenium import webdriver
#import chromedriver_autoinstaller

#chromedriver_autoinstaller.install()

import time
import sys
from konfig import Config

#function
def get_config() :
    try :
        cc = Config("env.ini")
        env = cc.get_map('env')

    except Exception as ex:
        print('config file not found : env.ini')
        sys.exit()

    return env
#end function




argument=sys.argv #캡쳐할 방송 스케줄 코드

env = get_config()
if env['IS_DEV'] :
    url= "devliveadmin.jasongroup.co.kr/Analytic/view/"
else :
    url= "liveadmin.jasongroup.co.kr/Analytic/view/"
print("url : "+url)
sys.exit
if int(argument[1]) >0 :
    options = webdriver.ChromeOptions()
    options.add_argument('headless')
    options.add_argument('window-size=820x1920')


    driver = webdriver.Chrome(options=options)

    driver.implicitly_wait(2) #3초 딜레이

    url = url+argument[1]

    driver.get(url)
    time.sleep(5)
    #driver.implicitly_wait(5) #3초 딜레이
    #driver.set_window_size(1080,3000)
    #el = driver.find_element_by_tag_name('body')
    driver.save_screenshot(argument[1]+".png")

    driver.close()

    driver.quit()
    print("|^|ok")
else :
     print ("|^|fail")

