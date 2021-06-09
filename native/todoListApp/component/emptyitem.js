import React from 'react';
import {StyleSheet,Text,View} from 'react-native';

const EmptyItem=()=>{
    return(
        <View style={styles.Container}>
            <Text style={styles.Label}>
                하단에 "+" 버튼을 눌러 새로운 할일을 등록해 본다 
            </Text>
        </View>
    );
}
const styles = StyleSheet.create({
    Container: {
        flex: 1, 
    },
    Label:{}
});
export default EmptyItem;