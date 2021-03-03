var express = require('express'), http = require('http');


var app = express();

app.set('port',process.env.PORT || 3000);

http.createServer(app).listen(app.get('port'),function(){
    
    console.log("Express 서버 시작 "+app.get('port'));
});

app.use(function(req,res,next){
    console.log('첫 번째 미들웨어에서 요청을 처리함.');
   
   var paramName = req.query.name; 
    
    console.dir(req.query);
    res.writeHead('200',{'content-type': 'text/html;charset=utf-8'});
    res.write('<h1>Express Server 에서 응답한 결과입니다.</h1>');
    res.write(paramName+'님 안녕~');
    
    res.end();
    
});

app.use('/',function(req,res,next){
      console.log('두 번째 미들웨어에서 요청을 처리함.');
    res.writeHead('200',{'content-type': 'text/html;charset=utf-8'});
    res.end('<h1>Express Server 에서 응답한 결과입니다.</h1> '+paramName+'님 안녕~');
})
