/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow strict-local
 */

import React from 'react';
import {SafeAreaView} from 'react-native';
import styled from 'styled-components/native';
import Counter from './component/Counter';

        

  const Container = styled.View`
  background-color: papayawhip;
`

const App=()=>{
  return(

    <Container>
      <Counter title="This is Counter App" initValue={5} /> 
    </Container>
  );
}
export default App;
