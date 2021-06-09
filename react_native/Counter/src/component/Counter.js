import React,{useState} from 'react';
import {SafeAreaView,View,Text, StyleSheet} from 'react-native';
import styled from 'styled-components/native';
import Button from './button';

const styles = StyleSheet.create({
    container: {
        flex: 1,
        padding: 20,
        backgroundColor:'blue',
      },
      red:{
          flex:1,
          padding:30,          
      },
      darkorange:{
          flex :2,
          padding:30,
          backgroundColor:"darkorange",
      }
  });

const Counter =({title,initValue}) =>{
    const {count,setCount} = useState(0);
    const [flexDirection, setflexDirection] = useState("column")

    return (      
        <View style={[styles.container, {
            flexDirection: "column"
        }]} >
    
            <View style={[styles.red,{backgroundColor: "red" }]} />
            <View style={styles.darkorange} />
            <View style={{ flex: 2, backgroundColor: "darkorange" }} />
            <View style={{ flex: 3, backgroundColor: "green" }} />
        </View>
      );
}

export default Counter;