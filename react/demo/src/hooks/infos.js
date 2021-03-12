import React,{useState,useEffect} from 'react';
import useinputs from './useInputs';

const Info = () =>{
    const [state,onChange] = useinputs({
        name:'',
        nickname :''
    });
    const {name,nickname} = state;
    return (
        <div>
            <div>
                <input value={name} onChange={onChange} />
                <input value={nickname} onChange={onChange} />
                <div>
                    <b>이름 : </b>{name} <br />
                    <b>닉네임 : </b> {nickname}
                </div>
            </div>
        </div>
    );
}
export default Info;