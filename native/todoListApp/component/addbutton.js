import React,{useState} from 'react';
import {
StyleSheet,
SafeAreaView,
Image,
TouchableOpacity,
TouchableWithoutFeedback,
Button,
View,
Text,
Alert,
} from 'react-native';

const styles = StyleSheet.create({
    Container: {
        position: 'absolute',
        bottom:0,
        alignSelf:'center',
        justifyContent:'flex-end',
    },
    ButtonContainer:{
        backgroundColor :'#999',
    },
    image :{
        width:70,
        height: 70,
        backgroundColor:'#fff',
    },
    text:{
        fontSize:30,
    },
    button: {
        alignItems: "center",    
        padding: 10
    }
});

const AddButton=(props)=>{
     
    return(
        <View  style={styles.Container}>            
             <TouchableOpacity  style={styles.ButtonContainer} onPress={btn_click} >
                <Image source={require('./img/add.png')} style={styles.image}  />               
            </TouchableOpacity>           
        </View>
    );
}
export default AddButton;