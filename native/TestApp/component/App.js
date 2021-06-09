/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow strict-local
 */

import React from 'react';
import {StyleSheet,SafeAreaView,View,Text} from 'react-native';
/* import Started from './starrted';
import Scroll from './scroll'
import Btn from './btn';
import Flat from './flat'; */
import Counter from './counter';

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor :'#EFE',
  }
});
const App = () => {
  return ( 
    <View style={styles.container}>
      <Counter title={"this is a counter app"}  initValue={5}/>
    </View>
  );
}
export default App;
/*   
const App = () => {
  return ( );
  return (
    <SafeAreaView style={styles.container}>
      <View style={{flex:0.5}}>
        <Scroll />
      </View>
      <View style={{flex:0.5}}>
        <Started />
      </View>
      <View style={{flex:0.5}}>
        <Btn />
      </View>
      <View style={{flex:1}}>
        <Flat />
      </View>
    </SafeAreaView>
  ); 
};
export default App;
*/