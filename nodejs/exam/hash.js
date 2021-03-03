var jwt = require('jsonwebtoken');
var token = jwt.sign({ foo: 'bar' }, 'shhhhh');
 //https://www.npmjs.com/package/jsonwebtoken
console.log(token);
