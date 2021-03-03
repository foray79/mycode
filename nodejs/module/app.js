var express = require('express'), http = require('http'), path = require('path');
var bodyparser = require('body-parser');

var app = express();
var router = express.Router();

app.set('views',__dirname+'/views');
app.set('view engine','ejs');
console.log('뷰 엔진 설정');


app.set('port',process.env.PORT || 80);
app.use(bodyparser.urlencoded({ extended :false}));
app.use(bodyparser.json());

http.createServer(app).listen(app.get('port'),function(){
    
    console.log("Express 서버 시작 "+app.get('port'));

});

router.route('/login',router).get(function (req,res){
    console.log("라우터 처리");
    //var context = {userid:'foray', username='foray'};
    //var content = {id:"foray"};
    req.app.render('login','',function (err,html){
                   if(err) {
                    console.error("뷰렌더링 중 오류 발생 "+err.stack);
                    return ;
                    }
                console.log("render : "+html.length);
        res.end(html);
                   });
 //  res.redirect("/public/login.html");
});
router.route("/process_login",router).post(function (req,res){
    var id =  req.body.userid;    
    var pwd = req.body.pwd;
    console.log("id : "+id+", password : "+pwd+" 로그인 시도");
    var context = { userid:id , username:'foray' }; 
    req.app.render('checkin',context,function (err,html){
     
        res.end(html);    
         });
});


app.use('/',router);