import React from 'react';
import {StyleSheet, View} from 'react-native';
import TodoListView from './todoListView';
import AddTodo from './addtodo';

const styles = StyleSheet.create({
  Container: {
    flex: 1,
  },
});

const Todo = () => {
  return (
    <View style={styles.Container}>
      <TodoListView />
      <AddTodo />
    </View>
  );
};

export default Todo;
