$(document).ready(function (){
    $("#register").on("click",function (){
      //  document.form1.action = "/post/save";
            document.form1.submit();
    });
    $("#modify").on("click",function (){
             document.modify_form.submit();
    });
});