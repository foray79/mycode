import React,{useState} from 'react';
import { View, KeyboardAvoidingView, TextInput, StyleSheet, Text, Platform, TouchableWithoutFeedback, Button, Keyboard  } from 'react-native';

import TodoInput from './todoinput';

const Test=()=>{
  const hideTodoInput=()=>{
    console.log("input press");
    Keyboard.dismiss
  }
  const btnclick=()=>{
    console.log("button press");
  }
  return (
    <TodoInput hideTodoInput = {hideTodoInput}/ >
  );

  return(
      <KeyboardAvoidingView
      behavior={Platform.OS === "ios" ? "padding" : "height"}
      style={styles.container}
      >
      <TouchableWithoutFeedback onPress={input_press} style={styles.tauch}>
        <View style={styles.inner}>
          <Text style={styles.header}>Header</Text>
          <TextInput placeholder="Username" style={styles.textInput} />
          <View style={styles.btnContainer}>
            <Button title="전송" onPress={btnclick} />
          </View>
        </View>
      </TouchableWithoutFeedback>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1
  },
  inner: {
    padding: 24,
    flex: 1,
    justifyContent: "space-around"
  },
  header: {
    fontSize: 36,
    marginBottom: 48
  },
  textInput: {
    height: 40,
    borderColor: "#000000",
    borderBottomWidth: 1,
    marginBottom: 36
  },
  btnContainer: {
    backgroundColor: "white",
    marginTop: 12
  },
  tauch : {
    borderColor:'#000000',
    backgroundColor : 'yellow',
  }

});

  
export default Test;