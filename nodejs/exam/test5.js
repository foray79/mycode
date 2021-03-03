var http = require("http");
var fs = require("fs");

var server = http.createServer();

var host = "192.168.102.148";
var port = 3000;
server.listen(port,host,'50000',function(){
    console.log('웹서버가 시작되었습니다'); 
});
server.on('connection',function(){});
server.on('request',function (req,res){
    
    console.log('클라이언트 요청');
    
    var filename="bird.png";
        fs.readFile(filename,function (err,data){
            res.writeHead(200,{"content-type" : "image/png"}) ;
            res.write(data);
            res.end();
    });
    
})
