/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow strict-local
 */

import React,{createContext,useState,useEffect} from 'react';
import {
  StatusBar,
  SafeAreaView,
  TextInput,
  StyleSheet,
  useColorScheme,
  View,Text,Button,KeyboardAvoidingView,Platform
} from 'react-native';
import {TodoListContextProvider} from './todoListContext';
import Todo from './todo';
import Test from './test';
const App = () => {
  const isDarkMode = useColorScheme() === 'dark';

  return (
    <Test />
);
  
  return (
    <TodoListContextProvider >
      <StatusBar barstyle="dark-content" />
          <View style={styles.sectionContainer}>
            <Todo />
          </View>
         
    </TodoListContextProvider>
  );
};

const styles = StyleSheet.create({
  sectionDescription: {
    marginTop: 8,
    fontSize: 18,
    fontWeight: '400',
  },
  input: {
    height: 40,
    margin: 12,
    borderWidth: 1,
  },
});

export default App;
