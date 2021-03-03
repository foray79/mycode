const db = require('./dbconfig.json');

console.log(db);


/*

Promise.then(f1).catch(f2);

const condition = true;
const promiss = new Promise((resolve,reject))=>{
    if(condition){
        reesolve('성공');
        
    }else{
        resolve('실패');
    }
});

promise 
.then ((message)=>{
    return new Promise((resolve,reject)=>{
        resolve(message);
    });
});
.then((message2)=>{
    console.log(message2);
    return new promise((resolve,reject)=>{
        resolve(message2);
    });
})
.then((message3)=>{
    console.log(message3);  
})
.catch((error)=>{
    console.error(error);
});
*/