var express = require('express');

var router = express.Router();

var controller = require("../controller/get");
/* GET home page. */
router.get('/', function(req, res, next) {
 // res.render('index', { title: 'Express' });
  controller.list(req,res);
});


router.get('/view', function(req, res, next) {
    controller.view(req,res);
});

module.exports = router;