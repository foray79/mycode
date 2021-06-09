import React,{useContext} from 'react';
import {

StyleSheet,
TextInput,

View,
} from 'react-native';
import { TodoListContext } from './todoListContext';

const styles = StyleSheet.create({
    Container: {
        flex: 0.1, 
    },
    TextInput :{
        width: 800,
        height: 144,
        backgroundColor:"#fff",
        borderColor:"#000000",
    }
});

const Input=({hideTodoInput})=>{
    const {addTodoList} = useContext(TodoListContext);
    return(    
        <TextInput
            style={styles.TextInput}
            autoFocus={true}
            autoCapitalize="none"
            autoCorrect={false}
            placeholder="할일을 입력한다."
            returnKeyType="done"
            onSubmitEditing={({nativeEvent})=>{              
                addTodoList(nativeEvent.text);
                hideTodoInput();
            }}
        />
    );
}

export default Input;