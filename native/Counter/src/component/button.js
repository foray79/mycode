import React from 'react';
import styled from 'styled-components/native';

const Container = styled.TouchableOpacity``;
const Icon = styled.Image``;

const Button = ({iconName,onPress})=>{
  return(
    <Container onPress={onPress} >
      <button>+</button>
       <button>-</button>
      {/* <Icon source={iconName =='plus' ? require('../Asset/img/add.png') : require('../Asset/img/remove.png')} /> */}
    </Container>
  );
}
 
export default Button;

