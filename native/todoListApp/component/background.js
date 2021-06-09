import React from 'react';
import {
StyleSheet,
TouchableWithoutFeedback,
View,TextInput,
} from 'react-native';
const Background=({hideTodoInput})=>{
    
    return(
        <TouchableWithoutFeedback onPress={hideTodoInput} style={styles.Container} >
            <View style={styles.BlackBackGound}>
                {/* <TextInput placeholder="Username" style={styles.textInput} /> */}
            </View>
        </TouchableWithoutFeedback>
    );
}
const styles = StyleSheet.create({
    Container: {
        position: 'absolute',
        top:0,
        bottom:0,
        left:0,
        right:0, 
    },
    BlackBackGound:{
        backgroundColor:'#000',
        opacity: 0.3,
        width :500,
        height: 300,
    },
    textInput: {
        height: 40,
        borderColor: "#000000",
        borderBottomWidth: 1,
        backgroundColor:"#ffffff",
        marginBottom: 36
      },
});
export default Background;