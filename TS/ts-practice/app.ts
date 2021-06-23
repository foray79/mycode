enum GenderType{
    Male='male',
    Female = 'female'
}
interface Student{
    id:number;
    name:string;
    age?:number;
    gender:GenderType;
    subject:string;
    courseComplete:boolean;
}

function getStudentDetail(studentId:number):Student {
    return{
        id:1234,
        name:'janet jackson',
        gender:GenderType.Female,
        subject:'Node js',
        courseComplete:true,
    };
};

type StrOrnum =  number|string;
let itemPrice: number;

const setItemPrice = (price:StrOrnum):void =>{
    if(typeof price =="string"){
        itemPrice=0
    }else{
        itemPrice = price;
    }
    console.log(itemPrice);
};

setItemPrice('50');