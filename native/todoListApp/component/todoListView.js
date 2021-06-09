import React from 'react';
import {SafeAreaView,StyleSheet} from 'react-native';
import Header from './header';
import TodoList from './todoList';

const styles = StyleSheet.create({
  Container: {
    flex: 1
  },
});

const TodoListView=()=>{
  return(
    <SafeAreaView style={styles.Container}>
      <Header />
      <TodoList />
    </SafeAreaView>
  );
}

export default TodoListView;