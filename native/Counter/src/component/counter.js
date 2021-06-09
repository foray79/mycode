import React,{useState} from 'react';
import {SafeAreaView,View,Text,StyleSheet} from 'react-native';
import { Colors } from 'react-native/Libraries/NewAppScreen';
import styled from 'styled-components/native';


const StyledView = styled.View`
flex: 1;
background-color: papayawhip;
`

const StyledText = styled.Text`
color: palevioletred;
`
const Button = styled.button`
  font-size: 1em;
  margin: 1em;
  padding: 0.25em 1em;
  border-radius: 3px;

  /* Color the border and text with theme.main */
  color: ${props => props.theme.main};
  border: 2px solid ${props => props.theme.main};
`;

const theme = {
    main: "mediumseagreen"
  };
const Counter =({title,initValue}) =>{

    return (      
        <StyledView>
        <StyledText>{title}</StyledText>
        <Button theme={{ main: "royalblue" }}>Ad hoc theme</Button>
        <Button theme={{ main: "darkorange" }}>Overridden</Button>

      </StyledView>
      );
}

export default Counter;