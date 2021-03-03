var mysql      = require('mysql');
const connection  = mysql.createConnection({
    host : '192.168.0.65',
    user : 'laravel',
    password : 'laravel_pw',
    database : 'laravel_db'
});

var usermodel = {
    list : {},
    result:{},
    getList : function (){
        connection.connect();
        connection.query("select *  from users",function(error,result){
            if(error) console.log(error);
            
        console.log("query exec");
            connection.end();
            return result;
       //     console.log(list);
            
        })
    },
    login: function (id,pwd){
        connection.connect();
        connection.query("select * from users where user_id='"+id+"'",function(error,result){
            if(error) console.log(error);
            let db_pwd = result[0].password;
            connection.end();
            console.log("pwd : "+pwd);
            console.log("password : "+db_pwd);
            this.result =  (db_pwd == pwd ? "true" : "false");            
            console.log(this.result);
            
        })
    }    
}


module.exports = usermodel;