from html2image import Html2Image
hti = Html2Image(
     custom_flags = [ '--virtual-time-budget=10000' ,  '--hide-scrollbars' ] 
)


hti.screenshot(url='https://foraydevliveadmin.jasongroup.co.kr/test.php', save_as='test.png')