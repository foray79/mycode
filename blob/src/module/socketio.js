import {io} from "socket.io-client";

let socket;
let server;
const SocketIO = () =>  {

        let host;
        server='remotess';
        const myname = "foray";
        const myid = "foray";

          if(server =="remote"){
            host = 'http://192.168.102.147:3000';
          }else{
            host ='http://192.168.102.148:2000';
          }

          if(typeof socket =='undefined'  || ! socket.connected ){
            socket = io(host,{transports: [ 'websocket' ]});         
          }
      console.log("socket connection");
        if(typeof socket !='undefined'  && ! socket.connected ) {
            //소켓 연결
          socket.emit("connectCounselor",{counselorId: myid, counselorName: myname});
        }else{
          console.error(`socket type : ${typeof socket} `,socket.connected);
        }        
}
export { socket,server };
export default SocketIO;
