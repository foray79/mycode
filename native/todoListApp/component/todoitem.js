import React from 'react';
import {StyleSheet,Text,View} from 'react-native';

const TodoItem=({text,onDelete})=>{
    return(
        <View style={styles.Container}>
            <Text style={styles.Label}>{text}</Text>
            <Button onPress={onDelete} title="삭제" />
        </View>
    );
}

const styles = StyleSheet.create({
    Container: {
        flex: 1, 
    },
    Label :{
        flex:1,
    }
});
export default TodoItem;
