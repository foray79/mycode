import React,{useState} from 'react';
import {SafeAreaView,View,Text,StyleSheet,Button} from 'react-native';

// Define what props.theme will look like
const theme = {
  main: "mediumseagreen"
};

const Test=()=>{
    return(
        <SafeAreaView>
        <Button>Normal</Button>
    
        <View>
          <Text>Themed</Text>
        </View>
      </SafeAreaView>
    );
}

export default Test