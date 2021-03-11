var model_post= require("../model/post");

var post ={
        paging : function (totaldata,pagePerdata,current_page)
        {/*
            const totaldata = 19;
            const pagePerdata = 10;
            const current_page = 1;
            */
            const page_count = 2;
            
            
            const total_page = Math.ceil(totaldata/pagePerdata); //총 페이지수
            const total_block = Math.ceil(total_page/page_count);// 페이지 그룹
            const now_block = Math.ceil(current_page/page_count);
            const start_line_number = (now_block -1)*page_count;
            const next_page = (page_count * now_block) +1;
            const prev_page = now_block - 1;
            const startPage =(now_block-1)*page_count+1;
			let endp = startPage+(page_count-1);
            var endPage;
            if(endp>total_page) endPage = total_page;
            else  endPage = endp;
            
            var pagination = {'total_page':total_page , 'total_block':total_block , 'current_page':current_page , 'now_block': now_block,'start_line_number':start_line_number,'page_count':page_count,'next_page':next_page,'prev_page':prev_page,'startPage':startPage,'endPage':endPage};
            console.log("========paging=======");
            console.log(pagination);
            console.log("========paging=======");
            return pagination;
            
            
            
            let last = total_block * pagePerdata;
            if(last>page_count) last = page_count;
            let first = last - (page_count - 1);
            if(first<0) first = 1;
            
            const next = last + 1;
            const prev = first - 1;
            
            if(total_page<1) first = last;
            let start = (total_page * (page_group-1))+1;
            
             console.log("last:"+last);
             console.log("first:"+first);
             console.log("next:"+next);
             console.log("prev:"+prev);            
            console.log("start:"+start);            
            
            var pagination = {'last':last , 'first':first , 'next':next , 'prev': prev,'total_page':total_page,'current_page':current_page,'start':start,'end':page_count};
            console.log(pagination);
            return pagination;
            var pagination ="";
            if(first > page_count){
                  pagination += "<li class='page-item' ><a class='page-link' href='/post/list?page="+prev+"'>Previous</a></li>";
            }
            for(var num =first ; num<=last;num++){
                if(num==current_page){
                    pagination += "<li class='page-item active' aria-current='page'><a class='page-link' href='#'>"+num+"</a></li>";
                }else pagination += "<li class='page-item' ><a class='page-link' href='/post/list?page="+num+"'>"+num+"</a></li>"; 
                
            }   
            
            if(next > total_page && next <total_page){
                pagination += "<li class='page-item' ><a class='page-link' href='/post/list?page="+next+"'>Next</a></li>";
            }
            return pagination;
            
        },
       list : async function (req,res){
           var page = req.body.page || req.query.page;
           var type = req.body.type || req.query.type;
           var param = "&type="+type;
            let limit = 3;            
            var data;
           
           var total_count = await model_post.get_total_count();
        
           
         
            page = (typeof(page) != "undefined" && page !== null) ? page-1:0 ;
           
            model_post.list({'page':page,'limit':limit},function (result){
                console.log("callback");
                data = result;
                
                console.log("get_total_count : "+total_count)   
                  paging =  post.paging(total_count,limit,page+1);
             
                let prt = {"data":data,"paging":paging};
                console.log(prt);
                
            if(type == 'html')    {
                res.render('postlist',{data:data,paging:paging,param:param});                
            }else  {
                res.send(JSON.stringify(prt));
            }
                
            });

            console.log("post get List exec=");
      },
    view : function (req,res){
            idx = req.body.idx || req.query.idx;
            model_post.get(idx, function (result){
                  console.log(result);
                console.log("view callback");
                if(typeof(result) != "undefined" && result !== null) {
                    res.render('view',{'data':result});

                }else {
                    let error = {'status':'500', 'stack':'' };
                      res.render('error',{'error':error});
                }
            });
    },
    write : function(req,res){        
         res.render('write');
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
    edit:function (req,res){
        idx = req.body.idx || req.query.idx;
        title = req.body.title || req.query.title;
        content = req.body.content || req.query.content;
        idx = req.body.idx || req.query.idx;
        id = "foray";
   
        data = {"title":title,"content":content,"id":id,"idx":idx};
       console.log(data);
     
        model_post.update(data,function (result){
        console.log(result);
            res.send("<html><head><script>alert('수정되었습니다.'); location.href='/post/view?idx="+result+"'; </script></head></html>");
        });        
       
    },
    modify : function (req,res){
        let idx = req.body.id || req.query.id;
         model_post.get(idx,function (result){
                console.log(result);
                console.log("modify callback");
            if(typeof(result) != "undefined" && result !== null) {
                    res.render('modify',{'data':result});

                }else {
                    let error = {'status':'500', 'stack':'' };
                      res.render('error',{'error':error});
                }
         });
    
    }
}


module.exports = post;