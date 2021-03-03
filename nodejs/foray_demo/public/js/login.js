function login(){
    console.log("login");
    let id = $("input[name='id']").val();
    let pwd = $("input[name='pwd']").val();
     console.log("id:"+id+",pwd : "+pwd);
    if(id=="" && pwd ==""){
        alert('아이디와 패스워드를 입력해주세요');
    }else {
        document.form1.submit();
    }
        
    
}