import React from 'react';
import Counter from './Counter';
import Counter2 from './Counter2';
import Info from './Info'
import Infos from './infos'
import Average from './Average'

class Hooks extends React.Component{

    render(){

        return(
        <div>
            <h1>hooks 사용법</h1>
            <p>state 사용 [counter component]</p>
            <Counter />
            <p>state 중복사용 [info component]</p>
            <Info />
            <p>reducer 사용 [counter2 component]</p>
            <Counter2 />
            <p>memo 사용 [average component]</p>
            <Average />
            <p>custom hooks [infos component]</p>
            <Infos />    
        </div>
        );
    }


}

export default Hooks;