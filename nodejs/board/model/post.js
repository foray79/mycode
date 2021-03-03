var mysql      = require('mysql');
const connection  = mysql.createConnection({
    host : '192.168.0.65',
    user : 'laravel',
    password : 'laravel_pw',
    database : 'laravel_db'
});

var post ={
   
    
    addpost : function (req,res){
    console.log("post 모듈안 addpost 실행");
    var title = req.body.title || req.query.title;
    var content = req.body.contents || req.query.content;
    var writer = reqt.body.writer || req.query.writer;
    console.log("요청 파라미터 : "+title+", "+content+", "+writer);

    },
    get_total_count:  function () {        
        return new Promise(function (resolve,reject){
            connection.query("select count(*) as cnt  from board ",function(error,result){
                 if(typeof(result[0]) != "undefined" && result[0] !== null) {
                    resolve(result[0].cnt);
                 }else resolve(result.cnt);                
               
              return result[0].cnt;
            })
        });
    
        /*
          connection.query("select count(*) as cnt  from board ",function(error,result){
                if(error) console.log(error);
            console.log("[model]get_total_count :"+result[0].cnt);
              return result[0].cnt;
        });
        */
    },
     list : function (page,callback){
         
        console.log("post module list exec");
         let limit = page.limit ||10 ; 
         let start  = page.page>0 ? page.page  *limit : 0;
         console.log("page:"+page.page+", limit :"+limit+", start :"+start);
         const sql = "SELECT *  FROM board ORDER BY idx LIMIT "+start+","+limit ;
        // console.log(" query : "+sql);
           // connection.connect(); 
            connection.query(sql,function(error,result){
                if(error) console.log(error);
           
            console.log("query exec");
               
                
         //   connection.end();     
                 callback(result);
            });
        
    },
    view : function (req,res,callback){
        let idx = req.query.id; 
 
         connection.query("select *  from board where idx = "+connection.escape(idx),function(error,result){
               if(error) console.log(error);
               // connection.end();                            
            
            callback(result);
        });
    },
    insert :function(data,callback){
         let title = data.title; 
         let content = data.content; 
         let id = data.id; 
        const sql = "INSERT INTO board(title,content,writer,reg_date)values('"+connection.escape(title)+"','"+connection.escape(content)+"','"+id+"',now())";
        console.log("sql : "+sql);
         connection.query(sql ,function(error,result){
               if(error) console.log(error);
               // connection.end();         
         //    console.log(result);
            
            callback(result);
        });
    },
    update :function(data,callback){
      
       let title = data.title; 
         let content = data.content; 
         let id = data.id; 
        let idx = data.idx
        const sql = "UPDATE board SET title = "+connection.escape(title)+",content="+connection.escape(content)+",mod_date=now() where idx = "+idx+" LIMIT 1";
        console.log("sql : "+sql);
         connection.query(sql ,function(error,result){
               if(error) console.log(error);
               // connection.end();         
         //    console.log(result);

            callback(idx);
        });  
    },
    get:function (idx,callback){
         if(typeof(idx) != "undefined" && idx !== null) {
           const sql = "select *  FROM  board where idx= "+idx+"";
            console.log("sql : "+sql);
             connection.query(sql ,function(error,result){
                   if(error) console.log(error);
                   // connection.end();         
                 //console.log(result[0]);
                 if(typeof(result[0]) != "undefined" && result[0] !== null) {
                    callback(result[0]);
                 }else callback(result);
            });
        }else{
            callback();
        }
    }
    
}

module.exports = post;