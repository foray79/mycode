import React from 'react';
import SassComponent from './sassComponent';
import CssModule from './CssModule';
import Styled from './styled';
class Style extends React.Component{

    render(){

        return(            
        <div>
            <h1>style 처리</h1>
            <p>css module [CssModule]</p>
            <CssModule / >
            <p>style [sassComponent]</p>
            <SassComponent /> 
            <p>Styled-Component [Styled]</p>
            <Styled /> 
        </div>
        );
    }


}

export default Style;