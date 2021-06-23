"use strict";
var GenderType;
(function (GenderType) {
    GenderType["Male"] = "male";
    GenderType["Female"] = "female";
})(GenderType || (GenderType = {}));
function getStudentDetail(studentId) {
    return {
        id: 1234,
        name: 'janet jackson',
        gender: GenderType.Female,
        subject: 'Node js',
        courseComplete: true,
    };
}
;
var itemPrice;
var setItemPrice = function (price) {
    if (typeof price == "string") {
        itemPrice = 0;
    }
    else {
        itemPrice = price;
    }  
};
setItemPrice('50');

const sendGreeting = (message='Hello',userName="Jack"):void =>{
    console.log(`${messaage}, ${userName}`);
}