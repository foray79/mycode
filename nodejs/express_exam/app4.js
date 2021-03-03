var exprees = require('express'), http = require('http'), path = require('path');
var bodyparser = require('body-parser'),static = require('serve-static');

var mysql  = require('mysql');

var app = exprees();
var router = exprees.Router();

/*웹서버 */
app.set('port', process.env.port || 80);
app.use(bodyparser.urlencoded({ extended :false}));
app.use(bodyparser.json());

http.createServer(app).listen(app.get('port'), function(){
    console.log("Express 서버 시작 "); 
});

let connection  = mysql.createConnection({
    host : '192.168.0.65',
    user : 'laravel',
    password : 'laravel_pw',
    database : 'laravel_db'
});

router.route('/join',router).get(function (req,res){
    console.log("라우터 처리");
    res.redirect("/public/join.html");
});
/*

router.route('/join',router).get(function (req,res){
   console.log("가입하기 라우터 처리");
    res.redirect("/public/join.html"); 
});*/

router.route('/process/join',router).post(function (req,res){
    console.log("가입하기 ");
    console.dir(req.body);
    
    var id =  req.body.userid;
    var name = req.body.name;
    var pwd = req.body.password;
    connection.connect(function(err) {
      if (err) {
        console.error('error connecting: ' + err.stack);
        return;
      }
    });

    connection.query("insert into users(user_id,name,password) values ('"+id+"','"+name+"','"+pwd+"')",function (error,result,fields){
       if(error) {
           throw error;
           return;
       }

        console.dir(result);
         console.log('the solution is '+result.insertId);
       // console.log('the solution is '+ result[0].keyword);
    });

    connection.end();
    
     var body = "<h1>회원 가입이 완료되었습니다.</h1>"+"<div> name: "+name+"</div>" +"<div> id: "+id+"</div>";   
    res.writeHead('200',{'content-type': 'text/html;charset=utf-8'});
    res.end(body);     
});

router.route('/memberlist',router).get(function (req,res){
     console.log("회원리스트 ");
        connection.connect(function(err) {
      if (err) {
        console.error('error connecting: ' + err.stack);
        return;
      }
    });

    connection.query("select * from users",function (error,result,fields){
       if(error) {
          console.error('error connecting: ' + error.stack);
           return;
       }

        
      
        var body = "<h1>회원 명단.</h1>";
        
        for (var i in result){
            console.dir(result[i]);
            var name = result[i].name;
            var id = result[i].user_id;
        body += "<p><div> name: "+name+"</div>" +"<div> id: "+id+"</div></P>";   
        }
        
    res.writeHead('200',{'content-type': 'text/html;charset=utf-8'});
    res.end(body);   
        
    });
    
});
app.use('/public',static(path.join(__dirname,'public')));

app.use('/',router);