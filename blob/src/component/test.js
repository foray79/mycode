import React,{useEffect,useState} from 'react' ;
import request from 'request';
import cheerio from 'cheerio';

function Test() {
    const [greeting,setGreeting] = useState();
    function _init(){
        setGreeting("hello");
        request('http://weather.com/weather/today/l/37.53,126.96?par=google', (error,resp,body)=>{

if(resp.statusCode == 200){//성공
    const $ = cheerio.load(body);
    const result = $(".CurrentConditions--primary--3xWnK > span").text();
    console.log("result",result)
}else{ //실패
    console.log("error",error);
}
        });
    }

    useEffect(() => {
        _init();
    }, [])

    return(
        <div>
           {greeting} Test
        </div>
    );
}
export default Test;
