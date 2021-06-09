import React, { useContext } from 'react';
import {FlatList} from 'react-native';
import { TodoListContext } from './todoListContext';
import EmptyItem from './emptyitem';
import TodoItem from './todoitem';
const TodoList=()=>{
    const {todoList,removeTodoList} = useContext(TodoListContext);

    return(
        <FlatList 
        data={todoList} 
        keyExtractor={(item,index)=>{
            return `todo-${index}`;        
        }}
        ListEmptyComponent={<EmptyItem />}
        renderItem={({item,index})=>(
            <TodoItem 
            text={item}
            onDelete={()=>removeTodoList(index)}
            />
        )}
        contentContainerStyle={todoList.length === 0 && {flex:1}}
        />
    );
}
export default TodoList;