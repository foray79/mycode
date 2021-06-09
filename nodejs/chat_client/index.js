

var socket = io();

socket.on('connect', function(){
    
    var name = prompt('대화명을 입력해주세요.', ''); 
    socket.emit('newUserConnect', name); 
}); 

socket.on('updateMessage', function(data){ 
    if(data.name === 'SERVER'){ 
        var info = document.getElementById('info'); 
        info.innerHTML = data.message; setTimeout(() => { info.innerText = ''; }, 1000); 
    }else{ 
        var chatMessageEl = drawChatMessage(data); 
        chatWindow.appendChild(chatMessageEl); 
        chatWindow.scrollTop = chatWindow.scrollHeight; 
    } 

});