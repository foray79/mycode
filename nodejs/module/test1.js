var user1= require('./user1');
var user = require('./user2');

function showUser()
{
    return user1.getUser().name+', '+user1.group.name;
}

function showUser1()
{
    return user.getUser().name+', '+user.group.name;
}

console.log('사용자 정보 : %s',showUser());
console.log("사용자 정보 : %s",showUser1());