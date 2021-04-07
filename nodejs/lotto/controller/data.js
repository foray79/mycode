var model= require("../model/data");
const logger =  require("loggerr");

var data ={    
	view : function (req,res){
        idx = req.body.idx || req.query.idx;
		model.get(idx,function(result){
            console.log(result);
            
            if(typeof(result) != "undefined" && result !== null) {
                let prt = {'status':200,"data":data};
                res.send(JSON.stringify(prt));

            }else {
                let error = {'status':500, 'stack':'' };
                  res.send(JSON.stringify(error));
            }
        });
	},
    write : function(req,res){      
		 date = req.body.date || req.query.date;
         number = req.body.number || req.query.number;
		bonus  = req.body.bonus || req.query.bonus;
        data = {'date':date,'number':number,'bonus':bonus};
		 res.send("<html><body><h1>'처리되었습니다.'</h1>");
		   console.log("처리됨");
		   console.log("date : "+date+",number : "+number+", bonus : "+bonus);
           console.log(data);
           model.write(data, function (result){
            console.log("ok :");
            //console.log( result);
            //idx = result['affectedRows'];
            //res.send("")
            //let prt = {"data":data,"paging":paging};
            //res.send(JSON.stringify(prt));
        });
    } ,
    save:function (req,res){
        title = req.body.title || req.query.title;
        content = req.body.content || req.query.content;
        id = "foray";
        data = {"title":title,"content":content,"id":id};
        model_post.insert(data,function (result){
            console.log("insertID :"+ result['insertId']);
            idx = result['insertId'];
            res.send("<html><head><script>alert('처리되었습니다.'); location.href='/post/view?idx="+idx+"'; </script></head></html>")
        });
        /*  res.send('<html><h1>login</h1> <h3> title : '+title+'</h3> <h3> content : '+content+'</h3><h3> id : '+id+'</h3></html>');        */
        
    },   
}


module.exports = data;