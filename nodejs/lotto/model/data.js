var mysql      = require('mysql');
const connection  = mysql.createConnection({
    host : 'localhost',
    user : 'lotto',
    password : 'fhEheoqkr1!',
    database : 'lotto'
});

var data ={
    write :function(data,callback){
        let count = data.date; 
        let prize_number = data.number; 
        let bonus_number = data.bonus; 
      
       const sql = "INSERT INTO history(count,prize_number,bonus_number,reg_date)values("+connection.escape(count)+",'"+prize_number+"',"+connection.escape(bonus_number)+",now())";
       console.log("sql : "+sql);
        connection.query(sql ,function(error,result){
              if(error) console.log(error);
              // connection.end();         
        //    console.log(result);
           
           callback(result);
       });
   },
   get : function (idx,callback){
        if(typeof(idx) != "undefined" && idx !== null) {
            const sql = "select *  FROM  history where count= "+idx+"";
            console.log("sql : "+sql);
            connection.query(sql ,function(error,result){
                    if(error) console.log(error);
                    // connection.end();         
                //console.log(result[0]);
                if(typeof(result[0]) != "undefined" && result[0] !== null) {
                    callback(result[0]);
                }else callback();
            });
        }else{
            callback();
        }
   
   },
}
module.exports = data;