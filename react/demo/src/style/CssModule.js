import React from 'react'
import style from './CssModule.module.css'

const CssModule= () =>{
return(
    <div className={style.wrapper}>
         안녕하세요 저는 <span className="something">CSS Module~ !</span> 입니다.
    </div>
);
}

export default CssModule;