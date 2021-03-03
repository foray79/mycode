var mysql      = require('mysql');
const connection  = mysql.createConnection({
    host : '192.168.0.65',
    user : 'laravel',
    password : 'laravel_pw',
    database : 'laravel_db'
});

var usermodel = {
    list : {},
    getList : function (){
        connection.connect();
        connection.query("select *  from users",function(error,result){
            if(error) console.log(error);
            
        console.log("query exec");
            connection.end();
            return result;
       //     console.log(list);
            
        })
    }
    
}


module.exports = usermodel;