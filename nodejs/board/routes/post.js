var express = require('express');
var router = express.Router();

var post_controller = require("../controller/post");
/* GET home page. */
router.get('/', function(req, res, next) {
 // res.render('index', { title: 'Express' });
  post_controller.list(req,res);
});

router.get('/list', function(req, res, next) {
    post_controller.list(req,res);
});
router.get('/view', function(req, res, next) {
    post_controller.view(req,res);
});
router.get('/write', function(req, res, next) {
    post_controller.write(req,res);
});
router.post('/save', function(req, res, next) {
    post_controller.save(req,res);
});
router.get('/modify',function(req,res,next) {
   post_controller.modify(req,res); 
});
router.post('/edit', function(req, res, next) {
    console.log("edit");
    post_controller.edit(req,res);
});
module.exports = router;