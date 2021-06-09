import React from 'react';
import {
StyleSheet,
TextInput,
KeyboardAvoidingView,
View,
Platform,
TouchableWithoutFeedback
} from 'react-native';
import Input from './textinput';
import Background from './background';

const TodoInput=({hideTodoInput})=>{
    
    return(
        <KeyboardAvoidingView
        behavior={Platform.OS === 'ios' ? "padding" : "height"} style={styles.container}>
            <Background onPress={hideTodoInput} />
            <Input hideTodoInput={hideTodoInput} />
        </KeyboardAvoidingView>

    );
}
const styles = StyleSheet.create({
    Container: {
        flex: 1, 
    },
});

export default TodoInput;