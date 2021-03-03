var express = require('express'), http = require('http'), path = require('path');
var bodyparser = require('body-parser'),static = require('serve-static');
var expressSession = require('express-session');

var app = express();
var router = express.Router();
var expressErrorHandler = require('express-error-handler');


app.set('port',process.env.PORT || 80);
app.use(bodyparser.urlencoded({ extended :false}));
app.use(bodyparser.json());
http.createServer(app).listen(app.get('port'),function(){
    
    console.log("Express 서버 시작 "+app.get('port'));

});

app.use(expressSession({
    secret:'my key',
    resave : true,
    saveUninitialized:true
}));

var errorHandler = expressErrorHandler({
    static :{
        '404' : './public/404.html'
    }
});
   
router.route('/login',router).get(function (req,res){
    console.log("라우터 처리");
    res.redirect("/public/login.html");
});


router.route('/process/login/:name',router).post(function (req,res){
  
   console.log('로그인 라우터') ;
    var paramName = req.params.name;
    var paramId = req.body.id || req.query.id ;
    var paramPwd =  req.body.pwd || req.query.pwd;
    
    if(req.session.user){
        console.log("로그인상태")
        res.redirect('/public/product.html');
    }else{
        req.session.user = {
            id:paramId,
            name:'소녀시대',
            authorized:true
        };
        console.log("로그인됨");
    }
    
    var body = "<h1>express server response</h1>"+"<div> name: "+paramName+"</div>" +"<div> id: "+paramId+"</div>"+"<div> password: "+paramPwd+"</div>";
    body += "<br><br> <a href='/process/product'>상품 페이지로</a>";
    res.writeHead('200',{'content-type': 'text/html;charset=utf-8'});
    res.end(body);                                 
});
router.route('/process/logout').get(function(req,res){
   console.log("로그아웃 라우터");
    
    if(req.session.user){
           console.log("로그인 상태에서 로그아웃 합니다.");
        
        req.session.destroy(function(err){ 
            if(err) {throw err;}
            console.log("세션 삭제 - 로그아웃 처리");
            res.redirect('/public/login.html');
                                           
        });
    }else{
        console.log("로그인 안됨.");
        res.redirect('/public/login.html');
    }
});

router.route('/process/product').get(function(req,res){
   console.log("상품정보 호출") ;
    
    if(req.session.user){
        res.redirect('/public/product.html');
    }else{
        res.redirect('/public/login.html')
    }
});
/*app.all('*',function (req,res){
   res.status(404).send('<h1>ERROR -404 NOT FOUND </h1>') ;
});*/
app.use('/',router);
app.use('/public',static(path.join(__dirname,'public')));

app.use(expressErrorHandler.httpError(404));
app.use(errorHandler);


/*app.use('/login',function (req,res){
    console.log(" 로그인 페이지로 이동");
    res.redirect("/public/login.html");
});*/


