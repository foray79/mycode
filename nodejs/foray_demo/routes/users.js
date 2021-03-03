var express = require('express');
var router = express.Router();
var userModel = require('../model/users_model');


/* GET users listing. */

router.get('/', function(req, res, next) {
  res.render('login.ejs',{ title: 'Express' });
});

router.get('/login', function(req, res, next) {
     res.render('login', { title: 'Express' });
    
    res.send('<html><h1>login</h1></html>');    
});


router.post("/login_prc",function(req,res,next){
    
    let user_id=req.body.id;
    let pwd = req.body.pwd;
   userModel.login(user_id,pwd);
  
    let result  =  (userModel.reuslt == "true") ? "ok" : "fail";
    console.log("data result : "+userModel.reuslt);
    res.send('<html><h1>login</h1> <h3> ID : '+user_id+'</h3> <h3> PWD : '+pwd+'</h3><p>login result : '+result+'</p></html>');        
   
});

module.exports = router;
