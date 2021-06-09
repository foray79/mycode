import React,{useState,useEffect} from 'react';
import { StyleSheet, Button, View, SafeAreaView, Text, Alert,StatusBar,
    ToastAndroid } from 'react-native';

    
const Btn = () => {

    const showToast = () => {
        ToastAndroid.show("A pikachu appeared nearby !", ToastAndroid.SHORT);
        };
        const createTwoButtonAlert=()=>{
            Alert.alert("Alert Test");
        }
          
  return (
    <SafeAreaView style={styles.container}>
        <View>
        <Button
            title="Press me"
            onPress={()=>showToast()}
        />
        <Button color="#841584" title={"2-Button Alert"} onPress={createTwoButtonAlert} />
        </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    paddingTop: StatusBar.currentHeight,
  },
  scrollView: {
    backgroundColor: 'pink',
    marginHorizontal: 20,
  },
  text: {
    fontSize: 42,
  },
});

export default Btn;