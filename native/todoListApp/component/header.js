import React from 'react';
import {StyleSheet,Text,View} from 'react-native';

const Header=()=>{
    return(
        <View style={styles.Container} >
            <Text style={styles.label}>Todo List App</Text>
        </View>
    );
}

const styles = StyleSheet.create({
    Container: {
        flex: 1, 
    },
    label :{
        fontSize:24,
        fontWeight: 'bold',
    }
});
export default Header;