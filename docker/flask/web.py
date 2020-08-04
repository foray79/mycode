# -*- coding: utf8 -*-
from flask import Flask
from flask import request
from konlpy.tag import Kkma
from konlpy.tag import Okt
from konlpy.tag import Komoran
from konlpy.tag import Hannanum
#from konlpy.tag import Mecab
#import MeCab as mc

app = Flask(__name__)
okt = Okt()
kkma = Kkma()
komoran = Komoran() #userdic='/home/python/komoran_userdic.txt')
han = Hannanum()

@app.route('/')
def welcome():
    return 'welcome'
    
@app.route('/nlp', methods=["GET"])
def get():
    lexical = request.args.get('lexical')
    text = request.args.get('text')
    result = request.args.get('result')

    if text == None or text == '':
        return '?text=blank\n'
    # lexical
    if lexical == 'okt' : #or lexical == 'twitter' :
        #okt = Okt()
        if result == 'detail' :
            m = str(okt.pos(text))
        else :
            m = str(okt.nouns(text))
            
    elif lexical == 'komoran' : 
        if result == 'detail' :
            m = str(komoran.pos(text))
        else :
            m = str(komoran.nouns(text))
            
    #elif lexical == 'mecab' :
    #    mecab = Mecab()
    #    if result == 'detail' :
    #        m = str(mecab.pos(text))
    #    else :
    #        m = str(mecab.nouns(text))
            
    elif lexical == 'hannanum' :
       
        if result == 'detail' :
            m = str(han.pos(text))
        else :
            m = str(han.nouns(text))
            

    #elif lexical == 'mecab_cli' :
    #    t = mc.Tagger()
    #    m = t.parse(text)
        
    else :
        #kkma = Kkma()
        if result == 'detail' :
            m = str(kkma.pos(text))
        else :
            m = str(kkma.nouns(text))
        
        
    return str(m)


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=False)