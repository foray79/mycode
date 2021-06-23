// Setup basic express server
var express = require('express');
var app = express();
var path = require('path');
var server = require('http').createServer(app);
const io = require('socket.io')(server,{cors:{ orgin: '*:*'}});
const cors = require('cors');
const redisClient = require('redis').createClient('6379','192.168.0.191');
const redisIo = require('socket.io-redis');
const dateUtils = require('date-utils');
const cryptoJs = require("crypto-js");
let port = process.env.PORT || 2000;
let roomList = [];
let counselorList = [];

server.listen(port, () => {
  console.log('Server listening at port %d', port);
});

let checkExistsRoom = function (roomId, callback) {
  isAlreadyExists = false;
	console.log('check exists room function');
  redisClient.lrange('roomQueue', 0, -1, function (err, rlist) {
    console.log('room count', rlist.length);
    rlist.forEach(function (roomKey) {
      console.log("room key :  " + roomKey);
      if (roomId == roomKey) {
        isAlreadyExists =true;
      }
    });
    callback(isAlreadyExists);
  });
  
};

// Routing
app.use(express.static(path.join(__dirname, 'public')));

redisClient.on('error',(err) => {
  console.log('redis connection error',err);
});


// Chatroom

var numUsers = 0;

// Adapting Redis
io.adapter(redisIo({ host: '192.168.0.191', port: 6379 }));


io.on('connection', (socket) => {
    let addedCounselor = false;
    let curDate = new Date();
    

    console.log('connection id : ', socket.id);
    socket.on('connectCounselor', (data) => {
        console.log('connectCounselor', data);
        if (addedCounselor) return;

        socket.counselorId = data.counselorId;
        socket.counselorName = data.counselorName;
        counselorList.push({'counselorId':data.counselorId, 'socketId':socket.id});

        addedCounselor = true;
        let curDate = new Date();
        redisClient.hset(
            'counselorList',
            data.counselorId,
            JSON.stringify({
                counselorName: data.counselorName,
                connectTime: curDate.getTime(),
                level: 'normal'
            })
        );

        socket.join('waitingRoom');

        socket.emit('connectedOK', {
            message: 'OK'
        });
    });

    socket.on('disconnect', () => {
        if (addedCounselor) {
            console.log('disconnect', socket.counselorId);
            redisClient.hdel('counselorList', socket.counselorId);

            roomList.map(function (curRoom, idx) {
              console.log(curRoom, idx);
              console.log(roomList);
              console.log('room list', io.sockets.adapter.rooms);
              //socket.roomList.splice(0,0);
              socket.in(curRoom).emit('endCounsel');
              redisClient.lrem('roomQueue', 0, curRoom, function(err, res){
                console.log('lrem result', curRoom,  res);
              });
       
            });
       }
    });


    socket.on('makeRoom', (data) => {
        console.log('make room roomId', data.roomId);
        roomList.push(data.roomId);
        checkExistsRoom(data.roomId, (res)=>{
          console.log('exists room : ', res);
          if (res == false) {
            //redisClient.lpush('roomQueue', roomId);
          }
          socket.join(data.roomId);
          
          console.log('room list', io.sockets.adapter.rooms);
          console.log('roomlist: ',roomList);
          socket.emit('madeRoom', 'OK');
        });

    });

    socket.on('joinRoom', (data) => {
      console.log('join room roomId', data);

      socket.join(data.roomId);
      console.log('room list', io.sockets.adapter.rooms);
      socket.emit('joinRoom', 'OK');
      /*

      checkExistsRoom(roomId, (res) => {
        console.log('exists room : ', res);
        if (res == true) {
          socket.join(roomId);
          console.log('room list', io.sockets.adapter.rooms);
          socket.emit('joinRoom', 'OK');
        } else {
          console.log('join room failed');
          socket.emit('joinRoom', 'Failed');
          
        }
      });
      */

    });

    socket.on('leaveRoom',(data) => {
        console.log('roomId', data.roomId);

        socket.leave(data.roomId);
        
        redisClient.lrem('roomQueue', 0, data.roomId, function(err, res){
          console.log('lrem result', res);
        })

        roomList.map(function (curRoom, idx) {
          console.log(curRoom, idx);
          if(curRoom == data.roomId) {
            roomList.splice(idx,0);
          }
          
        });
        
        // 고객한테 emit - 
        socket.in(data.roomId).emit('endCounsel');
    });


  
  socket.on('newMessage', (data) => {
    let messageBody = { 
      'messageKey' : data.messageKey,
      'roomId' : data.roomId,
      'userName': data.userName,
      'message': data.message,
      'messageType' : 'counselor',
    };
    console.log(data);
    console.log('room list', io.sockets.adapter.rooms);
    socket.to(data.roomId).emit('onNewMessage', messageBody);
    
  });

  socket.on('typing', (data) => {
    socket.to(data.roomId).emit('onTyping', {
      roomId : data.roomId,
      messageType: 'counselor',
      typingType: true
    });
  });

  socket.on('stopTyping', (data) => {
    socket.to(data.roomId).emit('onStopTyping', {
      roomId : data.roomId,
      messageType: 'counselor',
      typingType: false
    });
  });

  socket.on('deleteMessage', (data) => {
    socket.to(data.roomId).emit('onDeleteMessage', {
      'messageKey' : data.messageKey,
      'roomId' : data.roomId,
      'messageType' : 'counselor',
    });
  });

  socket.on('newImage',(data)=>{
    socket.to(data.roomId).emit('onNewImage', {
      'image' : data.image,
      'roomId' : data.roomId,
      'messageType' : 'counselor',
    });
    console.log(data);
    });  

    socket.on('drawstart',(data)=>{
        socket.to(data.roomId).emit('onDrawStart', {
          'x' : data.x,
          'y' : data.y,
          'color' : data.color,
          'type' : data.type,
          'roomId' : data.roomId,
          'messageType' : 'counselor',
        });
    console.log(data);
    });  
    socket.on('drawmove',(data)=>{
        socket.to(data.roomId).emit('onDrawMove', {
          'x' : data.x,
          'y' : data.y,
          'roomId' : data.roomId,
          'messageType' : 'counselor',
        });
    console.log(data);
    });  
    socket.on('drawend',(data)=>{
        socket.to(data.roomId).emit('onDrawEnd', {          
          'roomId' : data.roomId,
          'messageType' : 'counselor',
        });
    console.log(data);
    });  
        socket.on('changeColor',(data)=>{
        socket.to(data.roomId).emit('onChangeColor', {          
          'roomId' : data.roomId,
            color:data.color,
          'messageType' : 'counselor',
        });
    console.log(data);
    });  
});
