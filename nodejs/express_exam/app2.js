var express = require('express'), http = require('http'), path = require('path');

var bodyparser = require('body-parser'),static = require('serve-static');

var app = express();
var router = express.Router();


app.set('port',process.env.PORT || 80);
app.use(bodyparser.urlencoded({ extended :false}));
app.use(bodyparser.json());
http.createServer(app).listen(app.get('port'),function(){
    
    console.log("Express 서버 시작 "+app.get('port'));

});
app.use('/public',static(path.join(__dirname,'public')));
   
router.route('/login',router).get(function (req,res){
    console.log("라우터 처리");
    res.redirect("/public/login.html");
});


router.route('/login/process/:name',router).post(function (req,res){
  var time = new Date();
   console.log('1st 라우터 :'+time) ;
    var paramName = req.params.name;
    var paramId = req.body.id || req.query.id ;
    var paramPwd =  req.body.pwd || req.query.pwd;
    
    var body = "<h1>express server response</h1>"+"<div> name: "+paramName+"</div>" +"<div> id: "+paramId+"</div>"+"<div> password: "+paramPwd+"</div>";
    res.writeHead('200',{'content-type': 'text/html;charset=utf-8'});
    res.end(body);                                 
});
app.all('*',function (req,res){
   res.status(404).send('<h1>ERROR -404 NOT FOUND </h1>') ;
});
app.use('/',router);


/*app.use('/login',function (req,res){
    console.log(" 로그인 페이지로 이동");
    res.redirect("/public/login.html");
});*/


