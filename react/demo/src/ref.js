import React from 'react';

class Ref extends React.Component{
    input=React.createRef();

    handlerFocus =()=>{
        this.input.current.focus();
    }
    render(){
        return(
            <div>
                <input ref={this.ref} />
                <button onClick={this.handlerFocus}>포커싱</button>
            </div>
        );
    }

}
export default Ref;