var http = require('http');


var winston = require('winston');


const logger = winston.createLogger({
  level: 'info',
  format: winston.format.json(),
  defaultMeta: { service: 'user-service' },
  transports: [
    //
    // - Write all logs with level `error` and below to `error.log`
    // - Write all logs with level `info` and below to `combined.log`
    //
    new winston.transports.File({ 
        filename: 'error.log', 
        level: 'error' ,
        format : winston.format.combine(
            winston.format.colorize(),
            winston.format.simple()
            
        )
                                }),
//    new winston.transports.File({ filename: 'combined.log' }),
  ],
});


var server = http.createServer();

var host = "192.168.102.148";
var port = 3000;
server.listen(port,host,function(){
    
    console.log('웹서버가 시작되었습니다 %d',port);
    logger.error("listen");
    
});

server.on('connection',function (socket){
    var addr = socket.address();
    console.log('클라이언트 접속 %s , %d',addr.addresss,addr.port);
       logger.error("connection");
})

server.on('request', function (req,res){
    console.log("클라이언트 요청이 들어옴");
      logger.error("request");
//    logger.error(req);
    
    var body="<h1>welcome nodeJS ~!</h1>";
    res.writeHead(200, {
        'Content-Length': Buffer.byteLength(body),
        'Content-Type': 'text/html'
      })
    
    
    res.end(body);
})

server.on('close',function (){
    logger.error("close");
   console.log("서버 종료");
});