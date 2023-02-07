# pip install chromedriver-autoinstaller

import chromedriver_autoinstaller
from selenium import webdriver

import time
import sys
argument=sys.argv
chromedriver_autoinstaller.install()


if int(argument[1]) >0 :
    options = webdriver.ChromeOptions()
    options.add_argument('headless')
    options.add_argument('window-size=820x1920')


    driver = webdriver.Chrome(chrome_options=options)


    driver.implicitly_wait(2) #3초 딜레이


    url = "http://foraydevliveadmin.jasongroup.co.kr/Analytic/view/11995" #+argument[1]
    driver.get(url)
    time.sleep(5)
    #driver.implicitly_wait(5) #3초 딜레이
    #driver.set_window_size(1080,3000)
    #el = driver.find_element_by_tag_name('body')
    driver.save_screenshot("11995.png")

    driver.close()

    driver.quit()
    print("|^|ok")
else :
     print ("|^|fail")