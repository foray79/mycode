var model= require("../model/data");


var get ={    
	view : function (req,res){
        idx = req.body.idx || req.query.idx;
		model.get(idx,function(result){
            console.log(result);
            
            if(typeof(result) != "undefined" && result !== null) {
                let prt = {'status':200,"data":result};
                res.send(JSON.stringify(prt));

            }else {
                let error = {'status':500, 'stack':'데이터가 없습니다.' };
                  res.send(JSON.stringify(error));
            }
        });
	},
    not_found : function (req,res){
        let error = {'status':500, 'stack':'잘못된 접근' };
        res.send(JSON.stringify(error));
	},
}


module.exports = get;