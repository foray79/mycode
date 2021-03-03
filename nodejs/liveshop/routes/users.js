var express = require('express');
var router = express.Router();

var usersModel = require('./model/users');


/* GET users listing. */
router.get('/', function(req, res, next) {
  res.send('respond with a resource');
});

router.get('/get', function(req, res, next) {
  res.send('get database');
    console.log("get model");
   var list =  await usersModel.getList();
   
    console.log("controller") ; 
     
   // cosole.log(list);
    res.send(jSON.stringify(list));
});

module.exports = router;
