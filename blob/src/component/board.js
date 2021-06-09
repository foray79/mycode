import React,{useState,useRef,useEffect} from 'react';
import "./board.css";
import Color from './color';
import socketio,{socket} from '../module/socketio';
import jsscompress from 'js-string-compression';
const roomId = "forayRoom";
socketio();

socket.emit('makeRoom',{roomId:roomId}); //-- 대화방 만들기
/*{sockek,roomId} */
const Board=() =>{
    const [loading,setLoading] = useState(false);
    const [imageUrl,setImageUrl] = useState('');

    const canvas = useRef();
    const img = useRef();
    const [point,setPoint] = useState({});
    const [nextPoint,setNextPoint] = useState({x:0,y:0});
    const [draw,setDraw] = useState(false);
    const [color,setColor] = useState('#000');
    const [figure,setFigure] = useState('line');
    const hm = new jsscompress.Hauffman();

/*   useEffect(() => {
    const _canvas = canvas.current;
    const ctx = _canvas.getContext("2d");    
    const rect = _canvas.getBoundingClientRect(); 

    _canvas.addEventListener("onMouseDown",mouseDown);
    _canvas.addEventListener("onMouseUp",mouseUp);
    _canvas.addEventListener("onMouseMove",mouseMove);

    img.current.addEventListener("onLoad",drawImage);
  }, []) */


/* 이미지 등록 == data url로 변환*/    
    const readUploadedFileAsDataURL = (inputFile) => {
        const temporaryFileReader = new FileReader();
      
        return new Promise((resolve, reject) => {
          temporaryFileReader.onerror = () => {
            temporaryFileReader.abort();
            return reject(new DOMException("Problem parsing input file."));
          };
      
          temporaryFileReader.onload = () => {
            return resolve(temporaryFileReader.result);
          };
          temporaryFileReader.readAsDataURL(inputFile);
        });
      
      };
         
    const renderPhotos = (photo,callback)=>{
 
        let photos = Object.keys(photo).map(function(k) { return photo[k] });
        console.log(photos);
        
        return photos.map(async(pt, key) => {     
          var photoStr = await(readUploadedFileAsDataURL(pt));
         // console.log(photoStr);

         callback( photoStr);
        });
    }

    const handleChange = (info) => {  //이미지 등록 버튼 
        setLoading(true);        
        renderPhotos(info.target.files,(photoList)=>{
            setImageUrl(photoList);           
            const comp_photo = hm.compress(photoList);
            socket.emit('newImage',{roomId:roomId,image:comp_photo});
        })
      };
       
/*canvas 그리기*/
const drawImage=()=>{ 
    const ctx = canvas.current.getContext("2d");    
    ctx.drawImage(img.current,0,0);
    ctx.save();
}
const restore=()=>{
  const ctx = canvas.current.getContext("2d");
  let rect = canvas.current.getBoundingClientRect(); 
  //ctx.restore();
  ctx.beginPath();
  ctx.color='#fff';
  ctx.clearRect(0, 0,rect.width,rect.height)
  ctx.closePath();
}
useEffect(() => {
  socket.emit("changeColor",{roomId:roomId,color:color});
},[color]);  


/*소켓 통신 처리*/
socket.on("onChangeColor",(data)=>{
  if(data.roomId == roomId){    
    setColor(data.color);
  }
});
socket.on("onNewImage",(data)=>{
  if(data.roomId == roomId){    
    const image = hm.decompress(data.image)
    setImageUrl(image);
  }
});
socket.on("onDrawStart",(data)=>{
  if(data.roomId == roomId){  
    if(typeof canvas.current !='undefined'){
      if(typeof canvas.current.getContext === "function") {      
        const ctx = canvas.current.getContext("2d");
        
        const posX = data.x;
        const posY = data.y;
        ctx.beginPath();
        ctx.moveTo(posX, posY);
      }else{
        console.log("error", canvas);
      } 
    }else {
      
    }
  }
});
socket.on("onDrawMove",(data)=>{
  if(data.roomId == roomId){
    if(typeof canvas.current !='undefined'){
      if(typeof canvas.current.getContext === "function") {   
          const ctx = canvas.current.getContext("2d");
          const posX = data.x;
          const posY = data.y;
          ctx.strokeStyle = color;
          ctx.lineTo(posX, posY);
          ctx.stroke();         
      }
    }
  }
});
socket.on("onDrawEnd",(data)=>{
  if(data.roomId !== roomId){
    if(canvas.current.getContext) {
      const ctx = canvas.current.getContext("2d");
     ctx.closePath();
      setDraw(false); 
    }
  }
});

/*======소켓 여기까지=====*/

/*=======마우스 리스너====*/
  const mouseUp=(evt)=>{
    console.log("mouse UP");
    const ctx = canvas.current.getContext("2d");
    if(draw){ //마우스 업하면 그리기 끝.
       socket.emit("drawend",{roomId:roomId});
       ctx.closePath();
      setDraw(false);   
      ctx.save();      
    }
  }
 const mouseDown=(evt)=>{
    const ctx = canvas.current.getContext("2d");
    let rect = canvas.current.getBoundingClientRect(); 
    
    const posX = evt.clientX - rect.x;
    const posY = evt.clientY ;
    const type = "line";
    console.log(`x:${posX}, y: ${posY} > ${draw}`);
    if(!draw){ //마우스 다운순간부터 그리기 시작.. 시작점
      setDraw(true);
      setPoint({x:posX, y: posY});

      console.log(`1st : x:${posX}, y: ${posY} > ${draw}`);

      if(figure =='line'){
        ctx.beginPath();
        ctx.moveTo(posX, posY);
        setPoint({x:posX, y: posY});
      
        console.log(`x:${posX}, y: ${posY}`);
        socket.emit("drawstart",{roomId:roomId,x:posX,y:posY,color:color,type:type});
      }
    }
}

const mouseMove=(evt)=>{
      if(draw){ //마우스 down 상태에서만 그리기
       const ctx = canvas.current.getContext("2d");
        let rect = canvas.current.getBoundingClientRect(); 

        const posX = evt.clientX - rect.x;
        const posY = evt.clientY ;
      //  ctx.restore();
      const w = parseInt(posX) - parseInt(point.x);
      const h = parseInt(posY) - parseInt(point.y);

      if(figure =='line'){
        ctx.strokeStyle = color;
        socket.emit("drawmove",{roomId:roomId,x:posX,y:posY});
        ctx.lineTo(posX, posY);
        ctx.stroke();        
      }else if(figure == 'rect'){
      
        if(nextPoint.x >0 ){
        
         // ctx.fillRect(point.x, point.y, 209, 161);
         const prev_w = parseInt(nextPoint.x) - parseInt(point.x);
         const prev_h = parseInt(nextPoint.y) - parseInt(point.y);

         console.log(`2nd > ${point.x}, ${point.y}, ${w}, ${h} (${posX},${posY})`);
          ctx.restore();
         ctx.strokeRect(point.x,point.y,w,h);
         ctx.save();
      //ctx.beginPath();
     // ctx.strokeRect(point.X, point.y, w, h);         
        
          setNextPoint({x:posX,y:posY});
         
        }else{
          console.log(`set > ${point.x}, ${point.y}, ${w}, ${h} (${posX},${posY})`);
          setNextPoint({x:posX,y:posY});
        }
      }
    }
}
/*=======여기까지 리스너====*/
/* 좌표 */
      function getMousePos(_canvas, evt) { 
        let rect = _canvas.getBoundingClientRect(); 
       // console.log(`x : ${evt.clientX} , y: ${evt.clientY}`);
       
        return { x: evt.clientX - rect.left, y: evt.clientY - rect.top }; 
      }

const handleFigure=(e)=>{
  const value= e.target.className;
  setFigure(value);
}


    return (
     <>
      <input
        type="file"        
        multiple
        onChange={handleChange}
      />
    {/*    {imageUrl ? <img src={imageUrl} alt="avatar" style={{ width: '10%' }} /> : "uploadButton"}

       {imageUrl ? imageUrl.length : 0 }
 */}
        <canvas   height="800" width="800"  className="canvas" ref={canvas} onMouseDown={mouseDown} onMouseUp={mouseUp} onMouseMove={mouseMove}/>

        {imageUrl ? <img src={imageUrl} alt="avatar" style={{ width: '0%' }} ref={img} /> : ""}
        
        <div>        
          {point.x && point.y ? <span> | Click mouse position : {point.x}, {point.y} / {draw ? 'true' : 'false'} </span> : ""}
          {nextPoint.x && nextPoint.y ? <span> |두번째 마우스 position : {nextPoint.x}, {nextPoint.y} </span> : ""}
        </div>

       {/*  <img  src="https://mdn.mozillademos.org/files/5397/rhino.jpg" ref={img} onLoad={drawImage} /> */}
        <Color setColor={setColor} color={color}/> 
        <button onClick={restore} >지우기</button>{figure}
        <div className="figure" onClick={handleFigure}>
         
          <span className="tri">{figure =='tri' ? '▲' : '△'  }</span>
          <span className="rect">{figure =='rect' ? '■' : '□' }</span>
          <span className="line">{figure =='line' ? '―' : '↔'}</span>
        </div>
      </>
    );
}
export default Board;


