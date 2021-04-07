var express = require('express');

var router = express.Router();

var controller = require("../controller/data");
/* GET home page. */
router.get('/', function(req, res, next) {
 // res.render('index', { title: 'Express' });
  controller.list(req,res);
});

router.get('/list', function(req, res, next) {
    controller.list(req,res);
});
router.get('/view', function(req, res, next) {
    controller.view(req,res);
});
router.post('/write', function(req, res, next) {
    controller.write(req,res);
});
router.post('/save', function(req, res, next) {
    controller.save(req,res);
});
router.get('/modify',function(req,res,next) {
   controller.modify(req,res); 
});
router.post('/edit', function(req, res, next) {
    console.log("edit");
    controller.edit(req,res);
});
module.exports = router;