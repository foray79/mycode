import React, { useState } from 'react';
import { StyleSheet,SafeAreaView, Button,Text,View ,TouchableOpacity,Image} from 'react-native';
const Counter=({title,initValue})=>{
    
const [count,setCount] = useState(0);

const handlePlus=()=>
{
    console.log('plus');
    setCount(count+1);
}
const handleMinus=()=>
{
    console.log('minus');
    setCount(count-1);
}
const handleImg=()=>{
    console.log("image click");
}
const nowCount =initValue + count
    return(
        <SafeAreaView style={styles.container} >
            <View style={styles.titleContainer}>
            <Text style={styles.titlelabel} >
                {title}
            </Text>
            </View>

            <View style={styles.countContainer} >
                <Text style={styles.countLabel}>{nowCount}</Text>
            </View>

            <View style={styles.buttoncontainer}>
                <Button iconName="plus" onPress={handlePlus} title="+1" color={'#007aff'}/>
                <Button iconName="minus" onPress={handleMinus} title="-1" color={'red'}/>
                <TouchableOpacity style={styles.TouchableOpacity} activeOpacity={0.5} onPress={handleImg} >
                    <Image source={{
                        uri:'https://raw.githubusercontent.com/AboutReact/sampleresource/master/facebook.png',
                    }}
                    style={styles.buttonImageIconStyle}
                    />
                </TouchableOpacity>
            </View>

        </SafeAreaView>
    );
}

const styles = StyleSheet.create({
    container: {
      flex: 10,     
    },
    titleContainer : {
        flex:1,
        justifyContent :'center',
        alignItems : 'center',
    },
    titlelabel : {
        fontSize:24,
    },
    countContainer : {
        flex:2,
        justifyContent:'center',
        alignItems:'center',
    },
    countLabel : {
        fontSize:24,
        fontWeight:'bold',
    },
    buttoncontainer : {
        flex:1,
        flexDirection:'row',
        flexWrap:'wrap',
        justifyContent:'space-around',
    },
    TouchableOpacity :{
        flexDirection: 'row',
        alignItems: 'center',
        backgroundColor: '#485a96',
        borderWidth: 0.5,
        borderColor: '#fff',
        height: 40,
        borderRadius: 5,
        margin: 5,
        
    },
    buttonImageIconStyle: {
        padding: 10,
        margin: 5,
        height: 25,
        width: 25,
        resizeMode: 'stretch',
      },
  });

export default Counter;
