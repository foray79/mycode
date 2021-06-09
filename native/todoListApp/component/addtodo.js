import React,{useState} from 'react';
import {Button,Text,StyleSheet,View} from 'react-native';
import AddButton from './addbutton';
import TodoInput from './todoinput';
const AddTodo=()=>{
    const [showInput,setShowInput] = useState(false);
    btn_click=()=>{
        setShowInput(true);
    }
    return(
        <>
        <Text>{showInput ? "true":"false"}</Text>
            <AddButton onPress={btn_click} />
            {showInput && <TodoInput hideTodoInput={()=>setShowInput(false)}/>}
        </>
        
    );
}

const styles = StyleSheet.create({
    Container: {
        flex: 1, 
    },
});
export default AddTodo;
