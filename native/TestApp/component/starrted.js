import React from 'react';
import {StyleSheet,SafeAreaView,View,Text} from 'react-native';


    
const Started = () => {
return(    
    <SafeAreaView style={{flex:1}}>
      <View style={{ backgroundColor: "blue", flex: 0.3 }} />
      <View style={{ backgroundColor: "red", flex: 0.5 }} >
        <Text>Hello World!</Text>  
      </View>
    </SafeAreaView>
);
}
export default Started;