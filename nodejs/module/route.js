var router = {

router.route('/login',router).get(function (req,res){
    console.log("라우터 처리");
    //var context = {userid:'foray', username='foray'};
    //var content = {id:"foray"};
    req.app.render('login','',function (err,html){
                   if(err) {
                    console.error("뷰렌더링 중 오류 발생 "+err.stack);
                    return ;
                    }
                console.log("render : "+html.length);
        res.end(html);
                   });
 //  res.redirect("/public/login.html");
});
}
module.exports = router;